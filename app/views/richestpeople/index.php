<?php echo $data["title"]; ?>
<table>
    <thead>
        <th>id</th>
        <th>naam</th>
        <th>networth</th>
        <th>age</th>
        <th>Company</th>
        <th>update</th>
        <th>delete</th>
    </thead>
    <tbody>
        <?=$data['countries']?>
    </tbody>
</table>
<a href="<?=URLROOT;?>/homepages/index">terug</a>