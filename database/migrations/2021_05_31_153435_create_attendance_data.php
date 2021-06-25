<?php

use Illuminate\Database\Migrations\Migration;

class CreateAttendanceData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW attendance_data
                AS
                SELECT at.id as id,
                       u.id as user_id,
                       u.name as user_name,
                       u.mobile,
                       u.email,
                       ue.emp_code,
                       ue.flash_code as user_flash_code,
                       at.flash_code as att_flash_code,
                       ur.name as role_name,
                       ue.company_id,
                       cp.name as company_name,
                       at.date,
                       at.in_time,
                       at.out_time,
                       at.hours_worked,
                       at.difference,
                       at.status,
                       at.created_at,
                       at.created_by,
                       uc.name as att_created_by,
                       at.updated_at,
                       at.updated_by,
                       uu.name as att_updated_by,
                       u.created_at as user_registered_at
                FROM attendances as at
                         LEFT JOIN users as u ON at.user_id = u.id
                         LEFT JOIN users as uc ON at.created_by = uc.id
                         LEFT JOIN users as uu ON at.updated_by = uu.id
                         LEFT JOIN user_employees as ue ON at.user_id = ue.user_id
                         LEFT JOIN companies as cp ON ue.company_id = cp.id
                         LEFT JOIN user_roles as ur ON ue.user_role_id = ur.id
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
