<?php
$dictionary["Account"]["fields"]["party_types"] =
array(
    "name"            => "party_types",
    "vname"           => "LBL_PARTY_TYPES",
    "type"            => "multienum",
    "module"          => "Account",
    "size"            => "20",
    "options"         => "qualia_role_list",
    "default"         => null,
    "isMultiSelect"   => true,
    "mass_update"     => true,
    "required"        => false,
    "reportable"      => true,
    "audited"         => false,
    "importable"      => false,
    "readonly"        => false,
    "duplicate_merge" => false,
);
