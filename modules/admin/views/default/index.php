<div class="admin-default-index">
    <div class="container padding">
        <div class="title">
            <h1 class="title__header">Административная панель</h1>
            <span class="title__line"><i class="fa fa-car"></i></span>
        </div>
        <p>
            This is the view content for action "<?= $this->context->action->id ?>".
            The action belongs to the controller "<?= get_class($this->context) ?>"
            in the "<?= $this->context->module->id ?>" module.
        </p>
        <p>
            You may customize this page by editing the following file:<br>
            <code><?= __FILE__ ?></code>

            <? print_r(Yii::$app->user->identity) ?>
        </p>
    </div>
</div>
