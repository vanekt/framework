<?php $name = $request->get('name', 'World'); ?>
Hi <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>