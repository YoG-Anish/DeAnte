<?php
$block = basename(dirname(__FILE__));
register_block_type( get_template_directory() . '/blocks/'.$block.'/block.json' );