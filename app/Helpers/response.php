<?php
function view_404()
{
	return response()->view('errors.404', [], 404);
}

function view_301($url)
{
	return redirect()->to(url($url),301);
}

function redirect_301($url)
{
	return redirect()->to(url($url),301);
}