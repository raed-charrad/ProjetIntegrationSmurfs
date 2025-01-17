<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\DemandeCreationClubRequest;
use App\Http\Requests\DemandeCreationClubRequestEdit;
use App\Models\DemandeCreationClub;
use App\Models\Role;
use App\Models\club;
use App\Models\User;
use Illuminate\Http\Request;

class DemandeCreationClubController extends BaseController
{

    /**
     * Display a listing of the resource, displaying the demandeCreationsClubs of user.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        $dccs = $request->user()->demandeCreationClubs()->paginate(5);
        if (empty($dccs)) {
            return response()->json(['message' => 'No demande creation club found'], 404);
        }
        return response()->json($dccs, 200);
    }

    /**
     * Display a listing of the resource, displaying the demandeCreationsClubs of user and AllDemandes to admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->user()->roles()->get()->contains('name', "admin")) {
            $dccs = DemandeCreationClub::orderBy('created_at', 'desc')
                ->where('adminId', '=', null)
                ->where('status', '=', '0')
                ->where('status', '<>', '3')
                ->orWhere('adminId', '=', $request->user()->id)
                ->paginate(5);
            if (empty($dccs)) {
                return response()->json(['message' => 'No demande creation club found'], 404);
            }
            return response()->json($dccs, 200);
        } else {
            $dccs = $request->user()
                ->demandeCreationClubs()
                ->where('status', '<>', '3')
                ->orderBy('updated_at', 'desc')
                ->paginate(5);
            if (empty($dccs)) {
                return response()->json(['message' => 'No demande creation club found'], 404);
            }
            return response()->json($dccs, 200);
        }
    }

    /**
     * Display a listing of the resource, displaying the demandeCreationsClubs of user and AllDemandes to admin.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showMyDemandes($id)
    {
        if ($id == "admin") {
            $demandes = DemandeCreationClub::where('status','<>',3)->orderBy('updated_at', 'desc')->paginate(5);
            if (sizeof($demandes) > 0)
                return response()->json(
                    $demandes,
                    200
                );
            else
                return response()->json([], 404);
        } else {
            $demandes = DemandeCreationClub::where('status','<>',3)->where('responsableClubId', '=', $id)->orderBy('updated_at', 'desc')->paginate(5);
            if (sizeof($demandes) > 0)
                return response()->json(
                    $demandes,
                    200
                );
            else
                return response()->json([], 404);
        }
    }
    /**
     * Store a newly created resource in storage. while checking if user have an accept request
     * @param  \App\Http\Requests\DemandeCreationClubRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function create(DemandeCreationClubRequest $request)
    {
        $user = $request->user();
        $clubs = club::where('responsableClub', '=', $user->id)->count();
        if ($clubs == 0) {
            $nomClub = $request->input('nomClub');
            $logo = $request->input('logo');
            $dateCreation = $request->input('dateCreation');
            $activite = $request->input('activite');
            $president = $request->input('president');
            $vicePresident = $request->input('vicePresident');
            $responsableClubId = $request->user()->id;
            $data = array(
                "nomClub" => $nomClub,
                "logo" => $logo,
                "dateCreation" => $dateCreation,
                "activite" => $activite,
                "president" => $president,
                "vicePresident" => $vicePresident,
                "responsableClubId" => $responsableClubId,
            );

            $DemandeCreationClub = DemandeCreationClub::create($data);
            if ($DemandeCreationClub) {
                return response()->json([
                    'data' => [
                        'message' => 'Success',
                        'id' => $DemandeCreationClub->id,
                        'attributes' => $DemandeCreationClub
                    ]
                ], 201);
            }
            return "Success";
        }else{
            return $this->sendError('Error validation', ['error' => "you already have a club the request will be deleted"]);

        }
    }

    /**
     * update an existing resource in storage while checking if status ==0
     * @param  \App\Http\Requests\DemandeCreationClubRequestEdit  $request
     * @return \Illuminate\Http\Response
     */
    public function update(DemandeCreationClubRequestEdit $request, $id)
    {
        $DemandeCreationClub = DemandeCreationClub::find($id);
        if ($DemandeCreationClub) {
            $DemandeCreationClub->nomClub = $request->input('nomClub') ? $request->input('nomClub') : $DemandeCreationClub->nomClub;
            $DemandeCreationClub->logo = $request->input('logo') ? $request->input('logo') : $DemandeCreationClub->logo;
            $DemandeCreationClub->dateCreation = $request->input('dateCreation') ? $request->input('dateCreation') : $DemandeCreationClub->dateCreation;
            $DemandeCreationClub->activite = $request->input('activite') ? $request->input('activite') : $DemandeCreationClub->activite;
            $DemandeCreationClub->president = $request->input('president') ? $request->input('president') : $DemandeCreationClub->president;
            $DemandeCreationClub->vicePresident = $request->input('vicePresident') ? $request->input('vicePresident') : $DemandeCreationClub->vicePresident;
            $DemandeCreationClub->save();
            return response()->json([
                'message' => 'Update Success',
                'id' => $DemandeCreationClub->id,
                'attributes' => $DemandeCreationClub
            ], 201);
        } else {
            return response()->json([
                "demande non trouvée"
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DemandeCreationClub  $DemandeCreationClub
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $DemandeCreationClub = DemandeCreationClub::find($id);
        if ($DemandeCreationClub) {
            $DemandeCreationClub->delete();
            return response()->json([], 204);
        } else {
            return response()->json([
                'type' => 'DemandeCreationClub',
                'message' => 'demande non trouvée'
            ], 404);
        }
    }

    /**
     * accept a demandeCreationClub and create a club and add role to user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, $id)
    {
        $dcc = DemandeCreationClub::find($id);
        $user = User::find($dcc->responsableClubId);
        $adminId = $request->user()->id;

        $clubs = club::where('responsableClub', '=', $user->id)->whereHas('demandeCreationClub',function($query){
            $query->where('status','=',1);
        })->count();
        if ($clubs == 0) {
            if (isset($adminId)) {
                if (!$dcc) {
                    return response()->json("Not found", 404);
                } else {
                    $user = User::find($dcc->responsableClubId);
                    $user->roles()->attach(
                        Role::where('name', '=', 'responsableClub')->first()
                    );
                    $club = club::create([
                        'responsableClub' => $user->id,
                        'demandeCreationClubId' => $dcc->id,
                    ]);

                    $dcc->adminId = $adminId;
                    $dcc->status = 1;
                    $dcc->save();
                    return response()->json("Accepted", 200);
                }
            } else {
                return response()->json("Admin id required", 400);
            }
        } else {
            $dcc->status=3;
            $dcc->save();
            return $this->sendError('Error validation', ['error' => "Student already have a club the request will be deleted"]);
            // TODO: DELETE REQUEST

        }
    }

    /**
     * refuse a demandeCreationClub
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Integer $id
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request, $id)
    {
        $dcc = DemandeCreationClub::find($id);
        $adminId = $request->user()->id;
        if (isset($adminId)) {
            if (!$dcc) {
                return response()->json("Not found", 404);
            } else {

                $dcc->adminId = $adminId;
                $dcc->status = 2;
                $dcc->save();
                return response()->json("Declined", 200);
            }
        } else {
            return response()->json("Admin id required", 400);
        }
    }
}
