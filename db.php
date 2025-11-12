<?php
function get_db() {
    return new PDO('mysql:host=localhost;dbname=qa_db', 'root', '');
}
