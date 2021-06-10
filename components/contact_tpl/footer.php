<p>Связаться с нами можно по:</p>
<p class="c"><i class="fas fa-map-marker-alt"></i> <?= $contact->adress ?></p>
<p class="c">
    <?php
    foreach ($phones as $phone) :
        if ((int)$phone->public) :?>
            <a href="tel:<?= $phone->tel ?>" class="header__item"><i class="fas fa-mobile-alt"></i> <?= $phone->tel ?></a>
        <?php endif ?>
    <?php endforeach ?>
</p>
<p class="c">
    <?php
    foreach ($emails as $item) :
        if ((int)$item->public) :?>
            <a href="mailto:<?= $item->email ?>"><i class="fas fa-envelope-open"></i> <?= $item->email ?></a>
        <?php endif ?>
    <?php endforeach ?>
</p>
<a href="/contact" class="btn btn-warning">Показать расположение на карте</a>