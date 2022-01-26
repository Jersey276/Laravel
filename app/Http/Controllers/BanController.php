<?php

namespace App\Http\Controllers;

use App\Managers\UserManager;
use App\Models\Ban;
use App\Models\BanType;
use App\Models\User;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class BanController extends Controller
{
    public function bannedList(UserManager $manager)
    {
        $users = User::all();
        $bannedUsers = [];
        foreach ($users as $user) {
            if ($manager->isBanned($user)) {
                array_push($bannedUsers, $user);
            }
        }
        return view('admin/ban/banned/list', ['users' => $bannedUsers]);
    }
    
    public function userBanList(User $id)
    {
        return view('admin/ban/list',['bans' => $id->bans]);
    }

    public function banForm(User $id)
    {
        return view('admin/ban/form',['user' => $id, 'banType' => Bantype::all(), 'judge' => Auth::user()]);
    }
    
    public function unbanUser(Request $request, User $id)
    {
        $bans = $id->bans;
        foreach($bans as $ban) {
            /** @var Ban $ban */
            $ban->isActive = false;
            $ban->save();
        }
        $this->successFlash($request, 'Les bans de l\'utilisateur '.$id->name.' ont été supprimé avec succes');

        return redirect()->back();
    }

    public function banDelete(Request $request, User $id, Ban $ban)
    {
        $ban->delete();
        $this->successFlash($request, 'Le ban n°'.$ban->id.' de l\'utilisateur '.$id->name.' à été supprimé avec succes');
        return back();
    }

    public function unban(User $id, Ban $ban = null)
    {
        if(isset($idBan)) {
            $ban->isActive = false;
            $ban->save();
        } else {
            $bans = Ban::where(['user' => $id]);
            foreach ($bans as $ban) {
                $ban->isActive = false;
                $ban->save();
            }
        }
        return back();
    }

    public function ban(Request $request)
    {
        $ban = new Ban();
        $banType = BanType::find($request->bantype);
        $ban->bantype()->associate($banType);
        $ban->user()->associate(User::where(['name' => $request->user])->first());
        $ban->isActive = true;
        $ban->startedAt = Date::now();
        if (!$banType->isDefinitive) {
            $ban->endedAt = date_add(Date::now(), DateInterval::createFromDateString($banType->duration));
        }
        $ban->judge()->associate(Auth::user());
        $ban->save();
        return redirect('admin/users/banned');
    }

    public function banTypeList()
    {
        $bantypes = BanType::all();
        return view('admin/ban/type/list', ['bansTypes' => $bantypes]);
    }

    public function banTypeForm(int $id = null)
    {
        if (isset($id)) {
            $banType = Bantype::find($id);
            list($day,,$month,,$hour,,$minute,,$second) = explode(' ', $banType->duration);
            $time = [
                'month' => $month,
                'day' => $day,
                'hour' => $hour,
                'minute' => $minute,
                'seconds' => $second
            ];
            return view('admin/ban/type/form', ['type' => BanType::find($id), 'time' => $time]);
        }
        return view('admin/ban/type/form');
    }

    public function banTypeSend(Request $request, int $id = null)
    {
        if ($id != null) {
            /** @var Bantype $type */
            $type = Bantype::find($id);
        } else {
            $type = new BanType();
        }
        $type->name = $request->name;
        $type->slug = $request->slug;
        $type->description = $request->description;
        $type->isDefinitive = $request->isDefinitive;
        if($request->isDefinitive) {
            $type->isDefinitive = true;
            $type->duration = null;
        } else {
            $type->duration =
            $request->day . " days ".
            $request->month . " months ".
            $request->hour ." hours ".
            $request->minute ." minutes ".
            $request->second . " seconds ";
            $type->isDefinitive = false;
        }
        $type->save();
        return redirect('admin/users/ban/types');
    }

    public function banTypeDelete(int $id)
    {
        /** @var Bantype $bantype */
        $bantype = Bantype::find($id);
        $bantype->delete();
        return redirect('admin/users/ban/types');
    }
}
