<?php
session_start();

/* Functions */
function menu($page, $Auth, $googleDrive) {
	if ($Auth->isAuth()) {
		require_once('php/menu_in.php');
	} else {
		require_once('php/menu_out.php');
	}
}

function pageLink($link, $label, $page) {
	return '<a href="/'.$link.'" class="btn btn-stanley btn-outline-primary'.($link == $page ? ' active' : '').'">'.$label.'</a>';
}

function printListHighlightedName($list, $user) {
    $found = 0;
    foreach($list as $name) {
        if ($name == $user) {
            echo "<span class='text-success text-bold'>" . $name . "</span> ";
            $found = 1;
        } else {
            echo $name . " ";
        }
    }
    return $found;
}

function printListHighlightedId($list, $userID) {
    $found = 0;
    $first = true;
    foreach($list as $id => $name) {
    	if (!$first) {
    		echo ", ";
    	}
        if ($id == $userID) {
            echo "<span class='text-success text-bold'>" . $name . "</span>";
            $found = 1;
        } else {
            echo $name;
        }
        $first = false;
    }
    return $found;
}

function formatData($datum1,$datum2)
    {
    $maand = array('','januari','februari','maart','april','mei','juni','juli','augustus','september','oktober','november','december');
    $datum1 = new DateTime($datum1);
    $datum2 = new DateTime($datum2);
    if ($datum1->format('Y') == $datum2->format('Y'))
        {
        if ($datum1->format('m') == $datum2->format('m'))
            {
            if ($datum1->format('d') == $datum2->format('d'))
                {
                return $datum1->format('j ') . $maand[$datum1->format('n')] . $datum1->format(' Y');
                }
            else
                {
                return $datum1->format('j ') . "t/m " . $datum2->format('j ') . $maand[$datum2->format('n')] . $datum1->format(' Y');
                }
            }
        else
            {
            return $datum1->format('j ') . $maand[$datum1->format('n')] . " t/m " . $datum2->format('j ') . $maand[$datum2->format('n')] . $datum1->format(' Y');
            }
        }
    else
        {
        return $datum1->format('j ') . $maand[$datum1->format('n')]  . $datum1->format(' Y') . " t/m " . $datum2->format('j ') . $maand[$datum2->format('n')] . $datum2->format(' Y');
        }
    }


?>
