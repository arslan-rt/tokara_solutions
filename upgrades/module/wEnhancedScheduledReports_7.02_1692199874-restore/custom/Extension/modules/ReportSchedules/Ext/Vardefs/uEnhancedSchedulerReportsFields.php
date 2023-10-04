<?php

$dictionary["ReportSchedule"]["fields"]["show_report_in_body"] = array(
    "name"            => "show_report_in_body",
    "label"           => "Show Report in Email Body",
    "type"            => "bool",
    "module"          => "ReportSchedules",
    "default_value"   => false,
    "help"            => "",
    "comment"         => "",
    "audited"         => false,
    "mass_update"     => false,
    "duplicate_merge" => false,
    "reportable"      => true,
    "importable"      => "true",
);

$dictionary["ReportSchedule"]["fields"]["export_report_to_csv"] = array(
    "name"            => "export_report_to_csv",
    "label"           => "Export to CSV",
    "type"            => "bool",
    "module"          => "ReportSchedules",
    "default_value"   => false,
    "help"            => "",
    "comment"         => "",
    "audited"         => false,
    "mass_update"     => false,
    "duplicate_merge" => false,
    "reportable"      => true,
    "importable"      => "true",
);

$dictionary["ReportSchedule"]["fields"]["export_report_to_pdf"] = array(
    "name"            => "export_report_to_pdf",
    "label"           => "Export to PDF",
    "type"            => "bool",
    "module"          => "ReportSchedules",
    "default_value"   => false,
    "help"            => "",
    "comment"         => "",
    "audited"         => false,
    "mass_update"     => false,
    "duplicate_merge" => false,
    "reportable"      => true,
    "importable"      => "true",
);

$dictionary["ReportSchedule"]["fields"]["additional_email"] = array(
    "name"            => "additional_email",
    "label"           => "Add CC: Email Addresses",
    "type"            => "text",
    "module"          => "ReportSchedules",
    "help"            => "",
    "comment"         => "",
    "rows"            => "6",
    "cols"            => "80",
    "default_value"   => "",
    "required"        => false,
    "reportable"      => true,
    "audited"         => false,
    "importable"      => "true",
    "duplicate_merge" => false,
);

$dictionary["ReportSchedule"]["fields"]["bcc_additional_email"] = array(
    "name"            => "bcc_additional_email",
    "label"           => "Add BCC: Email Addresses",
    "type"            => "text",
    "module"          => "ReportSchedules",
    "help"            => "",
    "comment"         => "",
    "rows"            => "6",
    "cols"            => "80",
    "default_value"   => "",
    "required"        => false,
    "reportable"      => true,
    "audited"         => false,
    "importable"      => "true",
    "duplicate_merge" => false,
);

$dictionary["ReportSchedule"]["fields"]["add_instructions"] = array(
    "name"     => "add_instructions",
    "label"    => "Instructions",
    "type"     => "textarea",
    "module"   => "ReportSchedules",
    "dbType"   => "text",
    "rows"     => 6,
    "cols"     => 80,
    "comment"  => "",
    "required" => false,
);

$dictionary["ReportSchedule"]["fields"]["include_link_to_report"] = array(
    "name"            => "include_link_to_report",
    "label"           => "Include Link to Report",
    "type"            => "bool",
    "module"          => "ReportSchedules",
    "default_value"   => false,
    "help"            => "",
    "comment"         => "",
    "audited"         => false,
    "mass_update"     => false,
    "duplicate_merge" => false,
    "reportable"      => true,
    "importable"      => "true",
);
