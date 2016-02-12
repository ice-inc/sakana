<br>
<div class="col-xs-6 col-xs-offset-3">

<?php if ($commodity): ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th>商品名</th>
            <th>原価</th>
            <th>定価</th>
            <th>在庫</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($commodity as $item): ?>
        <tr>
            <td><?php echo $item['name']; ?></td>
            <td>￥<?php echo number_format($item['cost']); ?></td>
            <td>￥<?php echo number_format($item['price']); ?></td>
            <td><?php echo number_format($item['stock']['number']); ?></td>
            <td>
                <div class="btn-toolbar">
                    <div class="btn-group">
                        <?php echo Html::anchor('sakana/edit/'.$item['id'], '<i class="icon-wrench"></i> 編集', array('class' => 'btn btn-default btn-sm')); ?>
                        <?php echo Html::anchor('sakana/delete/'.$item['id'], '<i class="icon-trash icon-white"></i> 削除', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('削除してもよろしいですか?')")); ?>
                    </div>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php else: ?>
<h3>商品が登録されていません</h3>

<?php endif; ?><p>
</div>
