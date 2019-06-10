<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      if (\App::environment() !== 'production')
      {
        \Eloquent::unguard();

        // Truncate all tables, except migrations
        \DB::select('SET FOREIGN_KEY_CHECKS=0');
        $db = config('database.connections')['mysql']['database'];
        $col = "Tables_in_$db";
        foreach (\DB::select('SHOW TABLES') as $table) {
          if ($table->{$col} !== 'migrations') \DB::table($table->{$col})->truncate();
        }
        \DB::select('SET FOREIGN_KEY_CHECKS=1');
      }

      Model::unguard();
      DB::beginTransaction();
      $this->call([
          RoleAndPermissionSeeder::class,
          ModeTableSeeder::class,
          GenderTableSeeder::class,
          ReligionTableSeeder::class,
          CountryTableSeeder::class,
          LevelTableSeeder::class,
          InstitutionTypeTableSeeder::class,
          InstitutionTableSeeder::class,
          LgaTableSeeder::class,
          ModuleTableSeeder::class,
          QualificationTypeTableSeeder::class,
          RelationshipTableSeeder::class,
          StateTableSeeder::class,
          TitleTableSeeder::class,
          TownTableSeeder::class,
          SemesterTableSeeder::class,
          SubjectTableSeeder::class,
          UserTableSeeder::class,
          GlobalSettingTableSeeder::class,
          BatchTableSeeder::class,
          GradeOTableSeeder::class,
          OlevelQualificationTableSeeder::class,
          CourseLevelTableSeeder::class,
          ProgrammeTableSeeder::class,
          FacultyTableSeeder::class,
          DepartmentTableSeeder::class,
          GradeATableSeeder::class,
          CourseTableSeeder::class,
          QualificationTableSeeder::class,
          StaffTableSeeder::class,
          HodTableSeeder::class,
          DeanTableSeeder::class,
          ExamOfficerTableSeeder::class,
          FieldTableSeeder::class,
          ProgCoordinatorTableSeeder::class,
          CourseAdvicerTableSeeder::class,
          GeneralCourseTableSeeder::class,
          StaffCourseTableSeeder::class,
          ApplicantTableSeeder::class,
          ApplicationLevelTableSeeder::class,
          FeeTypeTableSeeder::class,
          PaymentTypeTableSeeder::class,
          FeeCheckExclusionTableSeeder::class,
          FeeTableSeeder::class,

      ]);
      DB::commit();
      Model::reguard();
    }
}
