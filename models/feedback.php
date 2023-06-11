<?php

function getAllFeedback() {
    $sql = "SELECT * FROM feedback ORDER BY id DESC";
    return getAssocResult($sql);
}

function getFeedback($id) {
    $sql = "SELECT * FROM feedback where id=$id";
    return getAssocResult($sql)[0];
}

function addFeedback() {
    $productId = !empty($_POST['productId']) ? $_POST['productId'] : 'null';
    $sql = "INSERT INTO `feedback` (`id`, `name`, `feedback`, `productId`) VALUES (NULL,'".$_POST['name']."','". $_POST['message']."',".$productId.')';
    return executeSql($sql);
}

function editFeedback() {
    $sql = "UPDATE `feedback` set name='".$_POST['name']."',feedback='".$_POST['message']."' where id=".$_POST['feedbackId'];
    return executeSql($sql);
}

function deleteFeedback() {
    $sql = "DELETE FROM feedback WHERE feedback.id=".$_GET['feedbackId'];
    return executeSql($sql);
}

function doFeedbackAction($action) {
    switch ($action) {
        case 'add':
            addFeedback();
            break;
        case 'edit':
            editFeedback();
            break;
        case 'delete':
            deleteFeedback();
            break;
    }
    if (!empty($_GET['src'])) {
        header('Location: ' . $_GET['src']);
    }
}

function getProductFeedback($id) {
    $sql = "SELECT * FROM feedback WHERE productId=$id";
    return getAssocResult($sql);
}