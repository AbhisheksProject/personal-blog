<?php
	function hashPassword($password){
        return hash_hmac('sha512', $password, 'BgLthpzmetbBy5XtHrmqdkkKLlWPbYizLmtwLiJ6F8DCWAER2jWykrjlii4jy55x08FHYNOOGMJqlEiY7oSch8Lgi967TNZFZ4N1');
    }