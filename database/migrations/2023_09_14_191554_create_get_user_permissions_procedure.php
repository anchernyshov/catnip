<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $procedure = "DROP PROCEDURE IF EXISTS `get_user_permissions`;
            CREATE PROCEDURE `get_user_permissions`(
                IN `p_user_name` VARCHAR(50)
            )
            LANGUAGE SQL
            NOT DETERMINISTIC
            CONTAINS SQL
            SQL SECURITY DEFINER
            COMMENT ''
            BEGIN
            
                DECLARE v_user_id INT;
                DECLARE v_role_id INT;
                DECLARE v_role_rn VARCHAR(50);
                
                SELECT user.id, role.id, role.name INTO v_user_id, v_role_id, v_role_rn
                FROM user
                INNER JOIN role ON user.role_id = role.id
                WHERE user.name = p_user_name COLLATE utf8mb4_unicode_ci;
                
                IF v_role_id = 1 THEN
                    SELECT v_user_id AS user_id, v_role_rn AS role_name, permission.name AS permission_name
                    FROM permission;
                ELSE
                    SELECT v_user_id AS user_id, v_role_rn AS role_name, permission.name AS permission_name
                    FROM permission
                    INNER JOIN role_to_permission ON permission.id = role_to_permission.permission_id
                    WHERE role_to_permission.role_id = v_role_id COLLATE utf8mb4_unicode_ci;
                END IF;
                
            END";

        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('get_user_permissions_procedure');
    }
};
