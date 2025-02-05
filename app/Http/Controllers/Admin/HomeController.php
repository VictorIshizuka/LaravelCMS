<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Page;
use App\Models\User;
use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function index(Request $request)
    {

        $days = $request->query('selectDate') ?? 7;

        if ($days > 30) {
            $days = 30;
        }

        $visitCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $usersCount = 0;


        $dateLimit = now()->subDays($days)->toDateString();
        $visitCount  = Visitor::where('date_access', '>=', $dateLimit)->count();//nao conta visitas distintas

        // Contagem de usuários online (últimos 5 minutos, independente do filtro)
        // $datelimit = date('Y-m-d', strtotime('-5 minutes'));

        $onlineList = Visitor::select('ip')->where('date_access', '>=', now()->subMinutes(5))->distinct('ip')->get();

        $onlineCount = $onlineList->count();

        $pageCount = Page::count();

        $usersCount = User::count();

        $pagePie = [];

        $visitsAll = Visitor::selectRaw('pages.title, COUNT(visitors.id) as count')
            ->join('pages', 'pages.id', '=', 'visitors.page_id')->where('date_access', '>=', $dateLimit)->groupBy('pages.title')->get();

        foreach ($visitsAll as $visit) {
            $pagePie[$visit['title']] = intval($visit->count);
        }

        $pageLabels = json_encode(array_keys($pagePie));
        $pageValues = json_encode(array_values($pagePie));

        return view('admin.home', [
            'visitCount' => $visitCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'usersCount' => $usersCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues,
            'days' => $days
        ]);
    }
}
