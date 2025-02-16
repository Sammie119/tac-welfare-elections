<?php

use App\Http\Controllers\BallotPositionController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionSettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingPositionController;
use App\Models\ElectionSettings;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

//Route::middleware('guest')->group(function () {
//    Route::get('/admin', function () {
//        return view('login');
//    });
//});

Route::get('/admin/dashboard', function () {
    $data['election'] = ElectionSettings::select('id')->orderByDesc('id')->first();
    return view('admin.dashboard', ($data['election']) ? $data : ['election' => 0]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::controller(VoteController::class)->group(function () {
        Route::get('/dashboard', 'index');
        Route::post('/vote', 'store')->name('vote.store');
        Route::get('/all_votes', 'getAllVotes')->name('all_votes');
        Route::post('/all_votes', 'votesCast')->name('all_votes');

        Route::get('/reports', 'getReport')->name('reports');
        Route::post('/reports', 'getGenerate')->name('reports.view');

        Route::get('/print_election_report/{id}', 'printElectionReport');

    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });

    Route::controller(ElectionSettingsController::class)->group(function () {
        Route::get('/elections', 'index')->name('elections');
        Route::post('/elections', 'store')->name('elections.store');
        Route::put('/elections', 'update')->name('elections.update');
        Route::post('/elections_destroy', 'destroy')->name('elections.destroy');
    });

    Route::controller(BallotPositionController::class)->group(function () {
        Route::get('/ballots', 'index')->name('ballots');
        Route::put('/ballots', 'update')->name('ballots.update');
    });

    Route::controller(VoterController::class)->group(function () {
        Route::get('/voters', 'index')->name('voters');
        Route::post('/voters', 'store')->name('voters.store');
        Route::put('/voters', 'update')->name('voters.update');
        Route::post('/voters_destroy', 'destroy')->name('voters.destroy');
    });

    Route::controller(VotingPositionController::class)->group(function () {
        Route::get('/voting_positions', 'index')->name('voting_positions');
        Route::post('/voting_positions', 'store')->name('voting_positions.store');
        Route::put('/voting_positions', 'update')->name('voting_positions.update');
        Route::post('/voting_positions_destroy', 'destroy')->name('voting_positions.destroy');
    });

    Route::controller(CandidateController::class)->group(function () {
        Route::get('/candidates', 'index')->name('candidates');
        Route::post('/candidates', 'store')->name('candidates.store');
        Route::put('/candidates', 'update')->name('candidates.update');
        Route::post('/candidates_destroy', 'destroy')->name('candidates.destroy');
        Route::get('/get_voting_positions', 'getVotingPositions');
    });
});

// Check SMS Balance
Route::get('/sms_balance', [SMSController::class, 'checkSMSBalance']);

Route::get('get_voter_code', [VoteController::class, 'getVoterCode']);

Route::get('get_voter_register_search', [VoterController::class, 'getVoterRegisterSearch']);

require __DIR__.'/auth.php';
