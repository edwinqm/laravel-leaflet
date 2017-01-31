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