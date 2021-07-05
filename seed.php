<?php 

require 'init.php';

// category

query('delete from category');

query('alter table category auto_increment=1');

$cat = ['Shirt','Hat','Shoe','Computer'];
foreach($cat as $c){
    query("insert into category (slug,name) values (?,?)",[slug($c),$c]);
}