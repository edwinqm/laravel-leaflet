<?php

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