<?php if (!empty($caracteristics_list)) { ?>

    <?php foreach ($caracteristics_list as $element) { ?>
        <?php if (!empty($element['feature_values'])) { ?>
            <div class="col-md-3"
                 style="height: 120px; overflow-y: scroll;margin-bottom: 15px;">
                <div style="padding: 10px; border-radius: 5px;background-color: #8080801a; width: 100%;">
                    <p style="padding: 0px; margin: 0px;"><b>
                            <?= $element['feature_name'] ?>
                            (<?= count($element['feature_values']) ?>)</b></p>
                    <?php foreach ($element['feature_values'] as $value) { ?>
                        <?php
                        $checked = '';
                        if (!empty($selected_features)) {
                            foreach ($selected_features as $check) {
                                if ($check->feature_id == $element['feature_id'] && $check->feature_value_id == $value['value_id']) {
                                    $checked = 'checked';
                                    break;
                                }
                            }
                        }
                        ?>

                        <?php if ($element['feature_type'] == 11) { ?>
                            <input id="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"
                                   type="checkbox"
                                   name="radio_feature[<?= $element['feature_id'] ?>]"
                                   value="<?= $value['value_id'] ?>"
                                <?= $checked ?>
                            >
                            <label for="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"><?= $value['value_name'] ?></label>
                            <br>
                        <?php } elseif ($element['feature_type'] == 3) {  // dump($value)?>
                            <div style="overflow: hidden; width: 100%;margin-bottom: 5px;">
                                <input id="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"
                                       type="checkbox"
                                       name="features[<?= $element['feature_id'] ?>][][<?= $value['value_id'] ?>]"
                                       value="<?= $value['value_id'] ?>"
                                    <?= $checked ?>
                                       style="float: left; margin-right: 5px;"
                                >
                                <label for="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"> </label>
                                <div style="background-color: <?= $value['color'] ?>; width: 15px; height: 15px; border-radius: 15px;float: left;margin-top: 3px;">
                                    <span style="margin-left: 20px;"><? //= $value['value_name'] ?></span>
                                </div>
                            </div>
                        <?php } else { ?>
                            <input id="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"
                                   type="checkbox"
                                   name="features[<?= $element['feature_id'] ?>][][<?= $value['value_id'] ?>]"
                                   value="<?= $value['value_id'] ?>"
                                <?= $checked ?>
                            >
                            <label for="<?= $element['feature_id'] ?>-<?= $value['value_id'] ?>"><?= $value['value_name'] ?></label>
                            <br>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php } ?>
<div class="col-md-12">
    <div class="col-md-12">
        <br>
        <button type="submit" class="btn green"><i class="fa fa-check"></i>
            Изменить
        </button>
    </div>
</div>