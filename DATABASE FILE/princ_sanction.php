<?php

function hod_approval($sid, $duty_leave, $start_date, $end_date) {
    // Check if the student is eligible for leave
    if (is_eligible($sid, $duty_leave, $start_date, $end_date)) {
        // Perform HOD approval process
        // Update the leave status in the database or leave management system
        update_leave_status($sid, $duty_leave, $start_date, $end_date, "HOD Approved");
        return true;
    } else {
        return false;
    }
}

function principal_sanction($sid, $duty_leave, $start_date, $end_date) {
    // Check if the leave has already been HOD approved
    if (is_hod_approved($sid, $duty_leave, $start_date, $end_date)) {
        // Perform principal's sanction process
        // Update the leave status in the database or leave management system
        update_leave_status($sid, $duty_leave, $start_date, $end_date, "Principal Sanctioned");
        return true;
    } else {
        return false;
    }
}

function is_eligible($sid, $duty_leave, $start_date, $end_date) {
    // Check eligibility criteria such as available leave balance, leave policy, etc.
    // Implement your logic here
    return true;  // Return true if eligible, false otherwise
}

function is_hod_approved($sid, $duty_leave, $start_date, $end_date) {
    // Check if the leave has been HOD approved
    // Implement your logic here
    return true;  // Return true if HOD approved, false otherwise
}

function update_leave_status($sid, $duty_leave, $start_date, $end_date, $status) {
    // Update the leave status in the database or leave management system
    // Implement your logic here
    echo "Leave status updated for student $sid from $start_date to $end_date: $status";
}

// Usage example
$sid = "Pavithra T";
$leave_type = "Duty Leave";
$start_date = "2023-06-12";
$end_date = "2023-06-13";

if (hod_approval($sid, $leave_type, $start_date, $end_date)) {
    if (principal_sanction($sid, $leave_type, $start_date, $end_date)) {
        echo "Leave sanctioned by the Principal.";
    } else {
        echo "Leave sanction by the Principal failed.";
    }
} else {
    echo "Leave approval by the HOD failed.";
}

?>
