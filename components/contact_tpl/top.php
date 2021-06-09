<div class="header__item">
<?php
$phones = explode('||', $contact->phone);
foreach ($phones as $phone) :
    if ($phone !== '') : $phone = explode(':', $phone); ?>
        <a href="tel:<?= $phone[0] ?>" class="mr-2"><i class="fas fa-mobile-alt"></i> <?= $phone[0] ?></a>
    <?php endif ?>
<?php endforeach ?>
</div>
<div class="header__item"><i class="far fa-clock"></i> <?= $contact->work ?></div>