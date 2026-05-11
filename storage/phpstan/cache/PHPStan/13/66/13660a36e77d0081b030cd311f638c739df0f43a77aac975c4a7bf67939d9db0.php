<?php declare(strict_types = 1);

// odsl-C:\Visual-studio-project-folder\FPR2 HERKANSING\app\Models\Bio.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Models\Bio
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.0-8.2.12-6684ea83a6edd2bbb596b89c44bd2f2ebca1553265fd4de3748a683fa6be7c73',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Models\\Bio',
        'filename' => 'C:/Visual-studio-project-folder/FPR2 HERKANSING/app/Models/Bio.php',
      ),
    ),
    'namespace' => 'App\\Models',
    'name' => 'App\\Models\\Bio',
    'shortName' => 'Bio',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => '/**
 * @property int $id
 * @property int $user_id
 * @property string $headline
 * @property string $summary
 * @property string|null $location
 * @property string|null $availability
 * @property string|null $website_url
 * @property string|null $linkedin_url
 * @property string|null $github_url
 * @property int|null $years_experience
 * @property \\Illuminate\\Support\\Carbon|null $updated_at
 * @property \\App\\Models\\User|null $user
 */',
    'attributes' => 
    array (
    ),
    'startLine' => 22,
    'endLine' => 46,
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
        'declaringClassName' => 'App\\Models\\Bio',
        'implementingClassName' => 'App\\Models\\Bio',
        'name' => 'fillable',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'user_id\', \'headline\', \'summary\', \'location\', \'availability\', \'website_url\', \'linkedin_url\', \'github_url\', \'years_experience\']',
          'attributes' => 
          array (
            'startLine' => 27,
            'endLine' => 37,
            'startTokenPos' => 37,
            'startFilePos' => 658,
            'endTokenPos' => 66,
            'endFilePos' => 863,
          ),
        ),
        'docComment' => '/**
 * @var list<string>
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 27,
        'endLine' => 37,
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
        'startLine' => 42,
        'endLine' => 45,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Models',
        'declaringClassName' => 'App\\Models\\Bio',
        'implementingClassName' => 'App\\Models\\Bio',
        'currentClassName' => 'App\\Models\\Bio',
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