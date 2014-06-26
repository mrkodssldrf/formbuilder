<?php echo Form::open(Formbuilder::getFormAttributes()) ?>
    <?php echo Formbuilder::openWrapper() ?>
        <?php foreach(Formbuilder::getFormFields() as $field) : ?>
            <?php echo Formbuilder::openSection() ?>
                <?php echo Formbuilder::getField($field) ?>
            <?php echo Formbuilder::closeSection() ?>
        <?php endforeach ?>
        <?php echo Form::button('Submit', array('type' => 'submit')); ?>
        <?php echo Form::button('Reset', array('type' => 'reset')); ?>
    <?php echo Formbuilder::closeWrapper() ?>
<?php echo Form::close() ?>