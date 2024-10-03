<?php

use DB as conn;

class ProjectHelper
{
    public static function getManagerInfo($id)
    {
        return conn::table('users')->where('id', $id)->first();
    }

    public static function getTeamName($projectID)
    {
        $data = conn::table('teams')->where('project_id', $projectID)->first();
        if ($data) {
            return $data;
        } else {
            return false;
        }

    }
    public static function getTeamsInfo($projectID)
    {
        $data = conn::table('teams')->where('project_id', $projectID)->get();
        if ($data) {
            return $data;
        } else {
            return false;
        }

    }

    public static function getUserInfo($UserId)
    {
        return conn::table('users')->where('id', $UserId)->first();
    }


    public static function getProjectName($projectID)
    {
        $data = conn::table('projects')->where('id', $projectID)->first();
        if ($data) {
            return $data->project_name;
        } else {
            return false;
        }

    }

}