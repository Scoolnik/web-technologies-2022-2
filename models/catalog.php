<?php

function getCatalog() {
    $sql = "SELECT * FROM products";
    return getAssocResult($sql);
}

function getProduct($id) {
    $sql = "SELECT * FROM products WHERE id=$id";
    return getAssocResult($sql)[0];
}
