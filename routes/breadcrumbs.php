<?php
/**
 * MAPS
 */
// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Home', route('home'));
});

// Leaflet
Breadcrumbs::register('leaflet', function($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Leaflet', route('maps.leaflet.index'));
});
// Basic
Breadcrumbs::register('basic', function($breadcrumbs){
    $breadcrumbs->parent('leaflet');
    $breadcrumbs->push('Basic', route('maps.leaflet.basic'));
});
// Prune Categories
Breadcrumbs::register('prune-categories', function($breadcrumbs){
    $breadcrumbs->parent('leaflet');
    $breadcrumbs->push('PruneCategories', route('maps.leaflet.prune-categories'));
});
// Prune Cluster
Breadcrumbs::register('prune-cluster', function($breadcrumbs){
    $breadcrumbs->parent('leaflet');
    $breadcrumbs->push('PruneCluster', route('maps.leaflet.prune-cluster'));
});
// Prune Control
Breadcrumbs::register('prune-control', function($breadcrumbs){
    $breadcrumbs->parent('leaflet');
    $breadcrumbs->push('PruneControl', route('maps.leaflet.prune-control'));
});

/**
 * MAYJEST
 */
// Nayjest Index
Breadcrumbs::register('nayjest', function($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Nayjest', url('nayjest/index'));
});
// Nayjest Examaple 1
Breadcrumbs::register('example1', function($breadcrumbs){
    $breadcrumbs->parent('nayjest');
    $breadcrumbs->push('Example 1', route('nayjest.example1'));
});
// Example 2
Breadcrumbs::register('example2', function($breadcrumbs){
    $breadcrumbs->parent('nayjest');
    $breadcrumbs->push('Example 2', route('nayjest.example2'));
});
Breadcrumbs::register('example3', function($breadcrumbs){
    $breadcrumbs->parent('nayjest');
    $breadcrumbs->push('Example 3', route('nayjest.example3'));
});
Breadcrumbs::register('example4', function($breadcrumbs){
    $breadcrumbs->parent('nayjest');
    $breadcrumbs->push('Example 4', route('nayjest.example4'));
});

/**
 * YAJRA
 */
Breadcrumbs::register('yajra', function($breadcrumbs){
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Yajra', url('datatable/index'));
});
Breadcrumbs::register('yajra1', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('Row Details', route('datatable.row-details'));
});
Breadcrumbs::register('yajra2', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('Example 2', route('datatable.example2'));
});
Breadcrumbs::register('yajra4', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('Filter Column', url('post-column-search'));
});
Breadcrumbs::register('yajra5', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('Master Details', url('master-details'));
});
Breadcrumbs::register('yajra6', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('Count Alias', url('count'));
});
Breadcrumbs::register('yajra3', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('DataTables as a Service', url('users'));
});
Breadcrumbs::register('yajra7', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('Service TwoDatatables', url('services/two-datatables'));
});
Breadcrumbs::register('yajra8', function($breadcrumbs){
    $breadcrumbs->parent('yajra');
    $breadcrumbs->push('Responsive', url('datatable/responsive'));
});