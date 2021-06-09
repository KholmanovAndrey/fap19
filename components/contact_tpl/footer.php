<p>Связаться с нами можно по:</p>
<p class="c"><i class="fas fa-map-marker-alt"></i> <?= $contact->adress ?></p>
<p class="c">
    <?php
    $phones = explode('||', $contact->phone);
    foreach ($phones as $phone) :
        if ($phone !== '') : $phone = explode(':', $phone); ?>
            <a href="tel:<?= $phone[0] ?>" class="header__item"><i class="fas fa-mobile-alt"></i> <?= $phone[0] ?></a>
        <?php endif ?>
    <?php endforeach ?>
</p>
<p class="c">
    <?php
    $emails = explode('||', $contact->email);
    foreach ($emails as $email) :
        if ($email !== '') : $email = explode(':', $email); ?>
            <a href="mailto:<?= $email[0] ?>"><i class="fas fa-envelope-open"></i> <?= $email[0] ?></a>
        <?php endif ?>
    <?php endforeach ?>
</p>
<a href="/contact" class="btn btn-warning">Показать расположение на карте</a>