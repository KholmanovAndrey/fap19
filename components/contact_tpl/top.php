<div class="header__item">
    <?php
    foreach ($phones as $phone) :
        if ((int)$phone->public) :?>
            <a href="tel:<?= $phone->tel ?>" class="mr-2"><i class="fas fa-mobile-alt"></i> <?= $phone->tel ?></a>
        <?php endif ?>
    <?php endforeach ?>
</div>
<div class="header__item">
    <?php
    foreach ($emails as $item) :
        if ((int)$item->public) :?>
            <a href="mailto:<?= $item->email ?>" class="mr-2"><i class="fas fa-envelope-open"></i> <?= $item->email ?></a>
        <?php endif ?>
    <?php endforeach ?>
</div>