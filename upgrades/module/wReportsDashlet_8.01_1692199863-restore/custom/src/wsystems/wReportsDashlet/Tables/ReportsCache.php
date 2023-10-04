<?php

$dictionary["wreportsdashlet_cache"] = array(
    "table"   => "wreportsdashlet_cache",
    "fields"  => array(
        "cache_key"    => array(
            "name"     => "cache_key",
            "type"     => "varchar",
            "len"      => 255,
            "required" => true,
            "isnull"   => false,
        ),
        "cache_data"   => array(
            "name"     => "cache_data",
            "type"     => "json",
            "dbType"   => "longtext",
            "required" => true,
        ),
        "cache_expire" => array(
            "name" => "cache_expire",
            "type" => "datetime",
        ),
    ),
    "indices" => array(
        array(
            "name"   => "idx_cache_key",
            "type"   => "primary",
            "fields" => array(
                "cache_key",
            ),
        ),
        array(
            "name"   => "idx_cache_key_expire",
            "type"   => "index",
            "fields" => array(
                "cache_key",
                "cache_expire",
            ),
        ),
        array(
            "name"   => "idx_cache_expire",
            "type"   => "index",
            "fields" => array(
                "cache_expire",
            ),
        ),
    ),
);
