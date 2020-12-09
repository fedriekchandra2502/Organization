<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{

    public function __construct()
    {

    }

    public function getCreateOrganization() {
        return view('organization.organization-create');
    }

    public function postCreateOrganization(Request $request) {
        $filename = $request->file('logo')->store('organization_logo','public');
        DB::table('organizations')->insert([
            'organization_name' => $request->input('organization_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
            'logo' => $filename
        ]);
        return redirect('home');
    }

    public function getEditOrganization($organization_id)
    {
        $user_id = auth()->user()->id;
        $userIsManager = $this->isOrganizationManager($user_id, $organization_id);
        if(!$userIsManager) {
            abort(403);
        }
        $organization = DB::table('organizations')->find($organization_id);

        return view(
            'organization.organization-edit',
            compact(
                "organization_id",
                "organization"
            )
        );
    }

    public function postEditOrganization(Request $request) {
        $organization_id = $request->input('organization_id');
        $user_id = auth()->user()->id;
        $userIsManager = $this->isOrganizationManager($user_id, $organization_id);
        if(!$userIsManager) {
            abort(403);
        }

        $update = [
            'organization_name' => $request->input('organization_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'website' => $request->input('website'),
        ];

        if($request->file('logo')) {
            $organization = DB::table('organizations')->find($organization_id);
            Storage::disk('public')->delete($organization->logo);
            $filename = $request->file('logo')->store('organization_logo','public');
            $update['logo'] = $filename;
        }

        DB::table('organizations')
        ->where('id', $organization_id)
        ->update($update);


        return redirect('/organization/'.$organization_id);
    }

    public function postDeleteOrganization(Request $request) {
        $organization_id = $request->input('organization_id');
        DB::table('organization_has_pic')->where('organization_id',$organization_id)->delete();
        DB::table('organization_has_manager')->where('organization_id',$organization_id)->delete();
        DB::table('organizations')->where('id',$organization_id)->delete();

        return redirect('home');
    }

    public function getOrganizationDetail($id)
    {
        $organization = DB::table('organizations')->find($id);
        $userIsManager = $this->isOrganizationManager(auth()->user()->id, $organization->id);
        $pics = DB::table('organization_has_pic')->where('organization_id',$id)->get();
        $managerList = DB::table('organization_has_manager')
                        ->select('user_id')
                        ->where('organization_id',$organization->id)
                        ->get();
        $managerListIds =  [];
        foreach($managerList as $manager) {
            array_push($managerListIds, $manager->user_id);
        }

        $managerCandidate = DB::table('users')
                    ->whereNotIn('id',$managerListIds)
                    ->get();
        return view('organization.organization',
        compact(
            "organization",
            "userIsManager",
            "pics",
            "managerCandidate"
        ));
    }

    public function postAssignManager(Request $request) {
        $newManager = [
            'organization_id' => $request->input('organization_id'),
            'user_id' => $request->input('user_id')
        ];
        DB::table('organization_has_manager')->insertOrIgnore($newManager);

        return back();
    }

    public function getCreatePIC($organization_id) {
        $user_id = auth()->user()->id;
        $userIsManager = $this->isOrganizationManager($user_id, $organization_id);
        if(!$userIsManager) {
            abort(403);
        }
        return view('pic.pic-create', compact("organization_id"));
    }

    public function postCreatePIC(Request $request) {
        $organization_id = $request->input('organization_id');
        $user_id = auth()->user()->id;
        $userIsManager = $this->isOrganizationManager($user_id, $organization_id);
        if(!$userIsManager) {
            abort(403);
        }

        $filename = $request->file('avatar')->store('avatars','public');
        $pic = [
            'organization_id' => $organization_id,
            'pic_name' => $request->input('pic_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'avatar' => $filename
        ];
        DB::table('organization_has_pic')->insert($pic);
        return redirect('/organization/'.$organization_id);
    }

    public function getEditPIC($organization_id,$pic_id) {
        $user_id = auth()->user()->id;
        $userIsManager = $this->isOrganizationManager($user_id, $organization_id);
        if(!$userIsManager) {
            abort(403);
        }
        $pic = DB::table('organization_has_pic')->find($pic_id);
        return view('pic.pic-edit',compact("organization_id","pic"));
    }

    public function postEditPIC(Request $request) {
        $organization_id = $request->input('organization_id');
        $user_id = auth()->user()->id;
        $userIsManager = $this->isOrganizationManager($user_id, $organization_id);
        if(!$userIsManager) {
            abort(403);
        }
        $pic_id = $request->input('pic_id');

        $update = [
            'pic_name' => $request->input('pic_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ];

        if($request->file('avatar')) {
            $pic = DB::table('organization_has_pic')->find($pic_id);
            Storage::disk('public')->delete($pic->avatar);
            $filename = $request->file('avatar')->store('avatars','public');
            $update['avatar'] = $filename;
        }

        DB::table('organization_has_pic')
        ->where('id', $pic_id)
        ->update($update);

        return redirect('/organization/'.$organization_id);
    }

    public function postDeletePIC(Request $request) {
        $pic_id = $request->input('pic_id');
        $organization_id = $request->input('organization_id');
        $user_id = auth()->user()->id;
        $userIsManager = $this->isOrganizationManager($user_id, $organization_id);

        if(!$userIsManager) {
            abort(403);
        }

        DB::table('organization_has_pic')->where('id',$pic_id)->delete();
        return back();
    }

    private function isOrganizationManager($user_id, $organization_id) {
        $isManager = DB::table('organization_has_manager')
                    ->where('organization_id',$organization_id)
                    ->where('user_id',$user_id)
                    ->first();
        if($isManager) {
            return true;
        }

        return false;
    }
}
