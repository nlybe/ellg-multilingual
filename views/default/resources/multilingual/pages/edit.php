<?php
/**
 * Elgg Multilingual Content
 * @package multilingual
 * 
 * Edit a page
 */

use Multilingual\MultilingualOptions;

$page_guid = (int) elgg_extract('guid', $vars);

elgg_entity_gatekeeper($page_guid, 'object', 'page', true);

$page = get_entity($page_guid);

$container = $page->getContainerEntity();
if ($container) {
	elgg_push_collection_breadcrumbs('object', 'page', $container);
}

ml_pages_prepare_parent_breadcrumbs($page);
// elgg_push_breadcrumb($page->getDisplayName(), $page->getURL());
elgg_push_breadcrumb(MultilingualOptions::getFieldValue('title', $page), $page->getURL());

$vars = pages_prepare_form_vars($page, $page->getParentGUID());

echo elgg_view_page(elgg_echo('edit:object:page'), [
	'content' => elgg_view_form('pages/edit', ['prevent_double_submit' => true], $vars),
]);
