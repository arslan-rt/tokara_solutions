<?php
$dictionary["Party_RQ_Party"]["fields"]["parent_party_type"] =
array(
    "name"            => "parent_party_type",
    "vname"           => "LBL_PARENT_PARTY_TYPE",
    "label"           => "LBL_PARENT_PARTY_TYPE",
    "type"            => "enum",
    "module"          => "Party_RQ_Party",
    "mass_update"     => true,
    "required"        => false,
    "reportable"      => true,
    "audited"         => false,
    "importable"      => true,
    "readonly"        => false,
    "duplicate_merge" => false,
    "options"         => "qualia_role_list",
    "default"         => "",
);
