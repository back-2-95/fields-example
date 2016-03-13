<?php return array (
  'name' => 'track',
  'fields' => 
  array (
    'artist' => 
    array (
      'name' => 'artist',
      'form' => 
      array (
        'widget' => 'text',
        'filters' => 
        array (
          0 => 'trim',
        ),
      ),
      'required' => 1,
    ),
    'title' => 
    array (
      'name' => 'title',
      'form' => 
      array (
        'widget' => 'text',
      ),
      'required' => 1,
    ),
    'description' => 
    array (
      'name' => 'description',
      'form' => 
      array (
        'widget' => 'editor',
      ),
    ),
    'cover' => 
    array (
      'name' => 'cover',
      'form' => 
      array (
        'widget' => 'image',
      ),
    ),
    'genre' => 
    array (
      'name' => 'genre',
      'form' => 
      array (
        'widget' => 'tags',
        'validators' => 
        array (
          'min' => 1,
        ),
      ),
      'multivalue' => 1,
      'required' => 1,
    ),
  ),
  'description' => 'Track represents musical track made with tracker software',
);
