<?php declare(strict_types = 1);

// odsl-D:\vscode\FPR HERKANSING\FPR2-HERKANSING\app\Models\StudyResult.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\StudyResult
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.0-8.2.12-d376d7cba708ff6a7f4c24b5d2132a020ad9f3122b8f97c66e9befe542b9d172',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\StudyResult',
        'filename' => 'D:/vscode/FPR HERKANSING/FPR2-HERKANSING/app/Models/StudyResult.php',
      ),
    ),
    'namespace' => 'App\\Models',
    'name' => 'App\\Models\\StudyResult',
    'shortName' => 'StudyResult',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @property int $id
 * @property int $user_id
 * @property string $course_code
 * @property float $earned_ec
 * @property \\Illuminate\\Support\\Carbon|null $created_at
 * @property \\Illuminate\\Support\\Carbon|null $updated_at
 * @mixin \\Illuminate\\Database\\Eloquent\\Builder<\\App\\Models\\StudyResult>
 * @method static \\Illuminate\\Database\\Eloquent\\Builder<\\App\\Models\\StudyResult> query()
 * @method static \\App\\Models\\StudyResult updateOrCreate(array<string, mixed> $a, array<string, mixed> $v = [])
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 19,
    'endLine' => 34,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Database\\Eloquent\\Model',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'fillable' => 
      array (
        'declaringClassName' => 'App\\Models\\StudyResult',
        'implementingClassName' => 'App\\Models\\StudyResult',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'user_id\', \'course_code\', \'earned_ec\']',
          'attributes' => 
          array (
            'startLine' => 21,
            'endLine' => 25,
            'startTokenPos' => 35,
            'startFilePos' => 691,
            'endTokenPos' => 46,
            'endFilePos' => 760,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 21,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'user' => 
      array (
        'name' => 'user',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Illuminate\\Database\\Eloquent\\Relations\\BelongsTo',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return BelongsTo<User, $this>
 */',
        'startLine' => 30,
        'endLine' => 33,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\StudyResult',
        'implementingClassName' => 'App\\Models\\StudyResult',
        'currentClassName' => 'App\\Models\\StudyResult',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));