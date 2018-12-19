<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
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
            OlevelTableSeeder::class,
            CourseLevelTableSeeder::class,
            ProgrammeTableSeeder::class,
            FacultyTableSeeder::class,
            DepartmentTableSeeder::class,
            GradeATableSeeder::class,
            CourseTableSeeder::class,
            QualfTableSeeder::class,
            StaffTableSeeder::class,
            HodTableSeeder::class,
            DeanTableSeeder::class,
            ExamOfficerTableSeeder::class,
            FieldTableSeeder::class,
            ProgCoordinatorTableSeeder::class,
            CourseAdvicerTableSeeder::class,
            GeneralCourseTableSeeder::class,
            StaffCourseTableSeeder::class,
        ]);
    }
}
