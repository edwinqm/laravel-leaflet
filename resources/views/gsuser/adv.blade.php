<?php
use \App\User;
use Nayjest\Grids\Grid;
use \Nayjest\Grids\GridConfig;
use \Nayjest\Grids\EloquentDataProvider;
use \Nayjest\Grids\IdFieldConfig;
use \Nayjest\Grids\FieldConfig;
use \Nayjest\Grids\ObjectDataRow;
use \Nayjest\Grids\FilterConfig;
use \Nayjest\Grids\Components\THead;
use \Nayjest\Grids\Components\FiltersRow;
use \Nayjest\Grids\Components\OneCellRow;
use \Nayjest\Grids\Components\RecordsPerPage;
use \Nayjest\Grids\Components\ColumnsHider;
use \Nayjest\Grids\Components\HtmlTag;
use \Nayjest\Grids\Components\TFoot;
use \Nayjest\Grids\Components\TotalsRow;
use \Nayjest\Grids\Components\Laravel5\Pager;
use \Nayjest\Grids\SelectFilterConfig;

?>

@extends('layouts.app')

@section('title', 'List of UsersGS ADV')

@include('partials.head')

{!! Html::style('leaflet/css/leaflet-1.0.3.css') !!}
{{--{!! Html::style('leaflet/css/LeafletStyleSheet.css') !!}--}}

{!! Html::script('leaflet/js/leaflet-src-1.0.3.js') !!}
{{--{!! Html::script('leaflet/js/PruneCluster.js') !!}--}}

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">GS USERS ADV</div>
                    <div class="panel-body map-container">


                        <?php

                        # Let's take a Eloquent query as data provider
                        # Some params may be predefined, other can be controlled using grid components
                        $query = (new User())
                                ->newQuery()
                                ->with('posts');

                        # Instantiate & Configure Grid
                        $grid = new Grid(
                                (new GridConfig)
                                        # Grids name used as html id, caching key, filtering GET params prefix, etc
                                        # If not specified, unique value based on file name & line of code will be generated
                                        ->setName('my_report')
                                        # See all supported data providers in sources
                                        ->setDataProvider(new EloquentDataProvider($query))
                                        # Setup caching, value in minutes, turned off in debug mode
                                        ->setCachingTime(5)
                                        # Setup table columns
                                        ->setColumns([
                                            # simple results numbering, not related to table PK or any obtained data
                                                new IdFieldConfig,
                                                (new FieldConfig)
                                                        ->setName('login')
                                                        # will be displayed in table header
                                                        ->setLabel('Login')
                                                        # That's all what you need for filtering.
                                                        # It will create controls, process input
                                                        # and filter results (in case of EloquentDataProvider -- modify SQL query)
                                                        ->addFilter(
                                                                (new FilterConfig)
                                                                        ->setName('login')
                                                                        ->setOperator(FilterConfig::OPERATOR_LIKE)
                                                        )
                                                        # optional,
                                                        # use to prettify output in table cell
                                                        # or print any data located not in results field matching column name
                                                        ->setCallback(function ($val, ObjectDataRow $row) {
                                                            if ($val) {
                                                                $icon = "<span class='glyphicon glyphicon-user'></span>&nbsp;";
                                                                $user = $row->getSrc();
                                                                return $icon . HTML::linkRoute('users.profile', $val, [$user->id]);
                                                            }
                                                        })
                                                        # sorting buttons will be added to header, DB query will be modified
                                                        ->setSortable(true)
                                            ,
                                                (new FieldConfig)
                                                        ->setName('status')
                                                        ->setLabel('Status')
                                                        ->addFilter(
                                                                (new SelectFilterConfig)
                                                                        ->setOptions(User::getStatuses())
                                                        )
                                            ,
                                                (new FieldConfig)
                                                        ->setName('status')
                                                        ->setLabel('Status')
                                                        ->addFilter(
                                                                (new SelectFilterConfig)
                                                                        ->setOptions(User::getStatuses())
                                                        )
//                                            ,
//                                                (new FieldConfig)
//                                                        ->setName('country')
//                                                        ->setLabel('Country')
//                                                        ->addFilter(
//                                                                (new SelectFilterConfig)
//                                                                        ->setName('country')
//                                                                        ->setOptions(get_countries_list())
//                                                        )
                                            ,
                                                (new FieldConfig)
                                                        ->setName('registration_date')
                                                        ->setLabel('Registration date')
                                                        ->setSortable(true)
                                            ,
                                                (new FieldConfig)
                                                        ->setName('comments_count')
                                                        ->setLabel('Comments')
                                                        ->setSortable(true)
                                            ,
                                                (new FieldConfig)
                                                        ->setName('name')
                                                        ->setLabel('Name')
                                                        ->setSortable(true)
                                            ,
                                                (new FieldConfig)
                                                        ->setName('posts_count')
                                                        ->setLabel('Posts')
                                                        ->setSortable(true)
                                            ,
                                        ])
                                        # Setup additional grid components
                                        ->setComponents([
                                            # Renders table header (table>thead)
                                                (new THead)
                                                        # Setup inherited components
                                                        ->setComponents([
                                                            # Add this if you have filters for automatic placing to this row
                                                                new FiltersRow,
                                                            # Row with additional controls
                                                                (new OneCellRow)
                                                                        ->setComponents([
                                                                            # Control for specifying quantity of records displayed on page
                                                                                (new RecordsPerPage)
                                                                                        ->setVariants([
                                                                                            10,
                                                                                                50,
                                                                                                100,
                                                                                                1000
                                                                                        ])
                                                                            ,
                                                                            # Control to show/hide rows in table
                                                                                (new ColumnsHider)
                                                                                        ->setHiddenByDefault([
                                                                                                'activated_at',
                                                                                                'updated_at',
                                                                                                'registration_ip',
                                                                                        ])
                                                                            ,
                                                                            # Submit button for filters.
                                                                            # Place it anywhere in the grid (grid is rendered inside form by default).
                                                                                (new HtmlTag)
                                                                                        ->setTagName('button')
                                                                                        ->setAttributes([
                                                                                                'type' => 'submit',
                                                                                            # Some bootstrap classes
                                                                                                'class' => 'btn btn-primary'
                                                                                        ])
                                                                                        ->setContent('Filter')
                                                                        ])
                                                                        # Components may have some placeholders for rendering children there.
                                                                        ->setRenderSection(THead::SECTION_BEGIN)
                                                        ])
                                            ,
                                            # Renders table footer (table>tfoot)
                                                (new TFoot)
                                                        ->addComponent(
                                                        # TotalsRow component calculates totals on current page
                                                        # (max, min, sum, average value, etc)
                                                        # and renders results as table row.
                                                        # By default there is a sum.
                                                                new TotalsRow([
//                                                                        'comments',
                                                                        'posts',
                                                                ])
                                                        )
                                                        ->addComponent(
                                                        # Renders row containing one cell
                                                        # with colspan attribute equal to the table columns count
                                                                (new OneCellRow)
                                                                        # Pagination control
                                                                        ->addComponent(new Pager)
                                                        )
                                        ])
                        );

                        ?>
                        # or using blade syntax (Laravel 5)
                        {!! $grid !!}


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-script')
    <script>

    </script>
@stop