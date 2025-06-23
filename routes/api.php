use App\Http\Controllers\API\IdeaGeneratorController;

Route::post('/generate-idea', [IdeaGeneratorController::class, 'generateIdea']);