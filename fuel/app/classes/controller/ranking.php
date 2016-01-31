<?php

class Controller_Ranking extends Controller 
{
    public function before()
    {
        //未ログインの場合、ログインページへリダイレクト
        if(!Auth::check()){
            Response::redirect('user/login');
        }
    }
    
    public function action_daily($date)
    {
        $data = array();

        // timestanpをフォーマット
        $day = date("Y/m/d", $date) . "\n";
        // 日別に一致したデータを集計
        $data['result'] = DB::select
            (
            "commodities.name",
            DB::expr("sum(number) AS sum_number"), 
            DB::expr("sum(order_children.price) AS sales")
        )
            ->from("order_children")
            ->join("commodities", "inner")
            ->on("commodity_id", "=", "commodities.id")
            ->where("date", "=", $day)
            ->group_by("commodity_id")
            ->order_by("sum_number", "desc")
            ->execute()->as_array();
        
        // 日時の計算
        $data['next'] = strtotime('+1 days', $date);
        $data['before'] = strtotime('-1 days', $date);
        $data['date'] = Date::forge()->get_timestamp();
        $data['title'] = Date::forge($date)->format('%Y年%m月%d日');
        
        return View::forge('ranking/daily', $data);
    }
    
    public function action_monthly($date)
    {
        $data = array();

        // timestanpをフォーマット
        $month = Date::forge($date)->format('%Y/%m');
        // 月別にデータ集計
        $data['result'] = DB::select
            (
            "commodities.name",
            DB::expr("sum(number) AS sum_number"), 
            DB::expr("sum(order_children.price) AS sales")
        )
            ->from("order_children")
            ->join("commodities", "inner")
            ->on("commodity_id", "=", "commodities.id")
            ->where(DB::expr("DATE_FORMAT(date, '%Y/%m')"), $month)
            ->group_by("commodity_id")
            ->order_by("sum_number", "desc")
            ->execute()->as_array();
        
        // 日時の計算
        $data['next'] = strtotime('+1 month', $date);
        $data['before'] = strtotime('-1 month', $date);
        $data['date'] = Date::forge()->get_timestamp();
        $data['monthly'] = Date::forge($date)->format('%Y年%m月');
        
        return View::forge('ranking/monthly', $data);
    }
    
    public function action_yearly($date)
    {
        $data = array();

        // timestanpをフォーマット
        $year = Date::forge($date)->format('%Y');
        // 年別にデータ集計
        $data['result'] = DB::select
            (
            "commodities.name",
            DB::expr("sum(number) AS sum_number"), 
            DB::expr("sum(order_children.price) AS sales")
        )
            ->from("order_children")
            ->join("commodities", "inner")
            ->on("commodity_id", "=", "commodities.id")
            ->where(DB::expr("DATE_FORMAT(date, '%Y')"), $year)
            ->group_by("commodity_id")
            ->order_by("sum_number", "desc")
            ->execute()->as_array();
        
        // 日時の計算
        $data['next'] = strtotime('+1 year', $date);
        $data['before'] = strtotime('-1 year', $date);
        $data['date'] = Date::forge()->get_timestamp();
        $data['yearly'] = Date::forge($date)->format('%Y年');
        
        return View::forge('ranking/yearly', $data);
    }
}