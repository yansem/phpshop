<?php foreach ($this->groups as $group_id => $group_title): ?>
    <section class="sky-form">
        <h4><?= $group_title; ?></h4>
        <div class="row1 scroll-pane">
            <div class="col col-4">
                <?php foreach ($this->attrs[$group_id] as $attr_id => $attr_title): ?>
                    <label class="checkbox">
                        <input type="checkbox" name="checkbox" value="<?= $attr_id; ?>"><i></i><?= $attr_title; ?>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endforeach; ?>