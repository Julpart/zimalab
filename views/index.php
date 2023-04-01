<a class="btn btn-primary col-md-8 offset-md-2" href="/user/create" style="margin-bottom: 10px">Создать пользователя</a>
<div class="row row-cols-2 row-cols-md-4 g-4">
<?php
$pageLink = $page;

if(count($users) == 1 and $pageLink != 1) $pageLink--;

foreach ($users as $item) : ?>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div class="card-head">
                    <h5 class="card-title">Имя: <?= $item['firstName'] ?></h5>
                    <h5 class="card-title">Фамилия: <?= $item['lastName'] ?></h5>
                    <h5 class="card-title">Почта: <?= $item['email'] ?><h2>
                </div>
                <div class="card-body">
                    <p>Фирма: <?= $item['companyName'] ?></p>
                    <p>Должность: <?= $item['position'] ?></p>
                    <p>Phone number 1: <?= $item['phoneNumber1'] ?></p>
                    <p>Phone number 2: <?= $item['phoneNumber2'] ?></p>
                    <p>Phone number 3: <?= $item['phoneNumber3'] ?></p>
                    <a href="/user/edit/?id=<?=$item['id']?>&page=<?=$page?>" class="btn btn-success">Редактировать</a>
                    <a href="/user/destroy/?id=<?=$item['id']?>&page=<?=$pageLink?>" class="btn btn-danger">Удалить</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<div class="col-md-8 offset-md-5" style="margin-top: 20px">
<ul class="pagination">
    <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>" >
        <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
    </li>
    <li class="page-item "><a class="page-link" href="?page=1">1</a></li>
    <li class="page-item"><a class="page-link" href="?page=<?php if($totalPages <= 1){ echo '1'; } ?>">Last</a></li>
    <li class="page-item <?php if($page >= $totalPages){ echo 'disabled'; } ?>">
        <a class="page-link" href="<?php if($page >= $totalPages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
    </li>
</ul>
</div>