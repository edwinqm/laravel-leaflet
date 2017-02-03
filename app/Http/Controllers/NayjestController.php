<?php

namespace App\Http\Controllers;

use HTML;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Nayjest\Grids\Components\Base\RenderableRegistry;
use Nayjest\Grids\Components\ColumnHeadersRow;
use Nayjest\Grids\Components\ColumnsHider;
use Nayjest\Grids\Components\CsvExport;
use Nayjest\Grids\Components\ExcelExport;
use Nayjest\Grids\Components\Filters\DateRangePicker;
use Nayjest\Grids\Components\FiltersRow;
use Nayjest\Grids\Components\HtmlTag;
use Nayjest\Grids\Components\Laravel5\Pager;
use Nayjest\Grids\Components\OneCellRow;
use Nayjest\Grids\Components\RecordsPerPage;
use Nayjest\Grids\Components\RenderFunc;
use Nayjest\Grids\Components\ShowingRecords;
use Nayjest\Grids\Components\TFoot;
use Nayjest\Grids\Components\THead;
use Nayjest\Grids\Components\TotalsRow;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\EloquentDataRow;
use Nayjest\Grids\FieldConfig;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\GridConfig;
use Nayjest\Grids\Grids;
use Nayjest\Grids\ObjectDataRow;

class NayjestController extends Controller
{
    public function example1()
    {
        $cfg = [
            'src' => 'App\User',
            'columns' => [
                'id',
                'name',
                'email'
            ],
        ];

        $grid = Grids::make($cfg);

        $text = "Basic grid example";

        $breadcrumbs = 'example1';

        return view('nayjest.example', compact('grid', 'text', 'breadcrumbs'));
    }

    public function example2()
    {
        $text = "Loading grid config";
        $grid = Grids::make(Config::get('grids.example2'));

        $breadcrumbs = 'example2';

        return view('nayjest.example', compact('grid', 'text', 'breadcrumbs'));
    }

    public function example3()
    {
        $cfg = new GridConfig();
        $cfg->setDataProvider(
            new EloquentDataProvider((new User())->newQuery())
        );
        $cfg->setColumns([
            new FieldConfig('id'),
            new FieldConfig('name'),
            new FieldConfig('email'),
        ]);

        $grid = new Grid($cfg);
        $text = 'Constructing grid programatically';
        $breadcrumbs = 'example3';

        return view('nayjest.example', compact('grid', 'text', 'breadcrumbs'));
    }

    public function example4()
    {
//        $user = User::where('id', 1)->first();
//
//        dd($user->posts());

        $cfg = new GridConfig();

        $cfg->setDataProvider(
            new EloquentDataProvider(User::query())
        );

        $cfg->setName('example_grid4');

        $cfg->setPageSize(15);

        $cfg->setColumns([
            (new FieldConfig)
                ->setName('id')
                ->setLabel('ID')
                ->setSortable(true)
                ->setSorting(Grid::SORT_ASC),

            (new FieldConfig)
                ->setName('name')
                ->setLabel('Name')
                ->setCallback(function ($val) {
                    return "<span class='glyphicon glyphicon-user'></span> {$val}";
                })
                ->setSortable(true)
                ->addFilter(
                    (new FilterConfig())
                        ->setOperator(FilterConfig::OPERATOR_LIKE)
                ),

            (new FieldConfig())
                ->setName('email')
                ->setLabel('Email')
                ->setSortable(true)
                ->setCallback(function ($val) {
                    $icon = '<span class="glyphicon glyphicon-envelope"></span>&nbsp;';
                    return '<small>'
                    . $icon
                    . link_to("mailto:$val", $val)
                    . '</small>';
                })
                ->addFilter(
                    (new FilterConfig())
                        ->setOperator(FilterConfig::OPERATOR_LIKE)
                ),
            (new FieldConfig())
                ->setName('posts')
                ->setLabel('Posts')
                ->setCallback(function ($val) {
                    return $val->count();
                })
                ->setSortable(false)

        ]);
        // thead
        $cfg->setComponents([
            (new THead())
                ->setComponents([
                    (new ColumnHeadersRow()),
                    (new OneCellRow())
                        ->setRenderSection(RenderableRegistry::SECTION_END)
                        ->setComponents([
                            new RecordsPerPage(),
                            new ColumnsHider(),
                            (new CsvExport())
                                ->setFileName('my_report', date('Y-m-d')),
                            new ExcelExport,
                            (new HtmlTag())
                                ->setContent('<span class="glyphicon glyphicon-refresh"></span> Filter')
                                ->setTagName('button')
                                ->setRenderSection(RenderableRegistry::SECTION_END)
                                ->setAttributes([
                                    'class' => 'brn btn-success btn-sm',
                                ])
                        ])
                ]),
            // tfoot
            (new TFoot())
            ->setComponents([
                (new OneCellRow())
                ->setComponents([
                    new Pager(),
                    (new HtmlTag())
                    ->setAttributes(['class' => 'pull-right' ])
                    ->addComponent(new ShowingRecords())
                ])
            ])
        ]);

        $grid = new Grid($cfg);
        $grid = $grid->render();

        $text = 'Full grid';
        $breadcrumbs = 'example4';

        return view('nayjest.example', compact('grid', 'text', 'breadcrumbs'));

    }
}
