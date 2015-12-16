<?php

use Symfony\Component\Routing;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

$linkForVasya = $urlGenerator->generate(
    'hello',
    array('name' => 'Vasya'),
    UrlGeneratorInterface::ABSOLUTE_URL
);

?>
Hi <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
<p><a href="<?= $linkForVasya  ?>">Vasya's link</a></p>
