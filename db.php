<?php
function get_db() {
    return new PDO('pgsql:host=localhost;dbname=qa_db', 'qa_user', 'qa_pass');
}
