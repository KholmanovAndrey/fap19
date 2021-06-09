<!--<div class="header__item"><i class="fas fa-map-marker-alt"></i> --><?//= $contact->adress ?><!--</div>-->
<?php
$phones = explode('||', $contact->phone);
foreach ($phones as $phone) :
    if ($phone !== '') : $phone = explode(':', $phone); ?>
        <a href="tel:<?= $phone[0] ?>" class="header__item"><i class="fas fa-mobile-alt"></i> <?= $phone[0] ?></a>
    <?php endif ?>
<?php endforeach ?>
<div class="header__item"><i class="far fa-clock"></i> <?= $contact->work ?></div>