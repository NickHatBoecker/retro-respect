<?php
const UPLOAD_DIR = '/uploads';
const UPLOAD_PATH = __DIR__.UPLOAD_DIR;

/**
 * @param string $slug
 *
 * @return string
 */
function createSlug($slug)
{
    $searches = [
        'Ä', 'ä',
        'Ö', 'ö',
        'Ü', 'ü',
        'ß', ' ',
    ];
    $replacements = [
        'Ae', 'ae',
        'Oe', 'oe',
        'Ue', 'ue',
        'ss', '-',
    ];

    $slug = str_replace($searches, $replacements, $slug);
    $slug = strtolower($slug);
    $slug = preg_replace('/[^A-Za-z0-9_-]/', '', $slug);

    return $slug;
}

/**
 * @param string $title
 * @param string $theme
 *
 * @return string
 */
function generateFilename($title, $theme = 'pink')
{
    return sprintf('%s/%s_%s.jpg', UPLOAD_PATH, createSlug($title), createSlug($theme));
}

/**
 * @param string $title
 * @param string $theme
 *
 * @return string
 */
function generateUrl($title, $theme = 'pink')
{
    return sprintf('%s/%s_%s.jpg', UPLOAD_DIR, createSlug($title), createSlug($theme));
}
