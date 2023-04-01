<?php
$url = '';

if(isset($id) and isset($page)){
    $url = 'update/?id=' . $id . '&page=' .$page;
}else{
    $url = 'store';
}
?>
<div class="col-md-5 offset-md-3">
<form action="/user/<?=$url?>" method="post">
    <label class="form-label" for="firstName">Имя:</label><br>
    <input class="form-control" type="text" id="firstName" name="firstName" value="<?= isset($user) ? $user->firstName: ''?>" required><br>
    <label class="form-label" for="lastName">Фамилия:</label><br>
    <input class="form-control" type="text" id="lastName" name="lastName" value="<?= isset($user) ? $user->lastName: ''?>" required><br>
    <label class="form-label" for="email">Почта:</label><br>
    <input class="form-control" type="email" id="email" name="email" value="<?= isset($user) ? $user->email: ''?>" required><br>
    <label class="form-label" for="companyName">Фирма:</label><br>
    <input class="form-control" type="text" id="companyName" name="companyName" value="<?= isset($user) ? $user->companyName: ''?>"><br>
    <label class="form-label" for="position">Должность:</label><br>
    <input class="form-control" type="text" id="position" name="position" value="<?= isset($user) ? $user->position: ''?>"><br>
    <label class="form-label" for="phoneNumber1">Номер телефона в формате: 80000000000</label><br>
    <input class="form-control" type="tel" id="phoneNumber1" name="phoneNumber1"
           pattern="8[0-9]{10}" value="<?= isset($user) ? $user->phoneNumber1: ''?>"><br>
    <label class="form-label" for="phoneNumber2">Номер телефона в формате: 80000000000</label><br>
    <input class="form-control" type="tel" id="phoneNumber2" name="phoneNumber2"
           pattern="8[0-9]{10}" value="<?= isset($user) ? $user->phoneNumber2: ''?>"><br>
    <label class="form-label" for="phoneNumber3">Номер телефона в формате: 80000000000</label><br>
    <input class="form-control" type="tel" id="phoneNumber3" name="phoneNumber3"
           pattern="8[0-9]{10}" value="<?= isset($user) ? $user->phoneNumber3: ''?>"><br>

    <button  class="btn btn-primary" type="submit">Отправить</button>
</form>
</div>