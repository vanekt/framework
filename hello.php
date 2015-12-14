<?php

$input = $request->get('name', 'World');
$response->setContent(sprintf('Hi %s', htmlspecialchars($input, ENT_QUOTES, 'UTF-8')));