<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * App identity tables. May already exist if sport-node-api previously
 * bootstrapped the same Postgres DB — create only what's missing and
 * normalize password_hash → password when needed.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('first_name')->default('');
                $table->string('last_name')->default('');
                $table->string('email')->nullable()->unique();
                $table->string('password')->nullable();
                $table->string('google_id')->nullable()->unique();
                $table->timestamps();
            });
        } else {
            // Node used password_hash — rename for Laravel Auth conventions.
            if (Schema::hasColumn('users', 'password_hash') && ! Schema::hasColumn('users', 'password')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->renameColumn('password_hash', 'password');
                });
            }
            if (! Schema::hasColumn('users', 'created_at')) {
                Schema::table('users', function (Blueprint $table) {
                    $table->timestamps();
                });
            }
        }

        if (! Schema::hasTable('password_reset_tokens')) {
            Schema::create('password_reset_tokens', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('token')->unique();
                $table->timestamp('expires_at');
                $table->timestamp('used_at')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->index('user_id');
            });
        }

        if (! Schema::hasTable('user_favorites')) {
            Schema::create('user_favorites', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('kind');
                $table->string('target_id');
                $table->json('meta')->nullable();
                $table->timestamp('created_at')->useCurrent();
                $table->unique(['user_id', 'kind', 'target_id']);
                $table->index(['user_id', 'kind']);
                $table->index(['kind', 'target_id']);
            });
        }

        if (! Schema::hasTable('social_posts')) {
            Schema::create('social_posts', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->string('kind');
                $table->text('body')->default('');
                $table->json('images')->nullable();
                $table->unsignedBigInteger('match_id')->nullable();
                $table->json('match_snapshot')->nullable();
                $table->string('pick')->nullable();
                $table->decimal('pick_odds', 10, 3)->nullable();
                $table->string('pick_label')->nullable();
                $table->json('stats')->nullable();
                $table->string('prediction')->nullable();
                $table->string('confidence')->nullable();
                $table->unsignedInteger('likes_count')->default(0);
                $table->unsignedInteger('comments_count')->default(0);
                $table->unsignedInteger('shares_count')->default(0);
                $table->timestamps();
                $table->index('user_id');
                $table->index(['kind', 'created_at']);
                $table->index('created_at');
                $table->index('match_id');
            });
        }

        if (! Schema::hasTable('social_post_likes')) {
            Schema::create('social_post_likes', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('post_id')->constrained('social_posts')->cascadeOnDelete();
                $table->timestamp('created_at')->useCurrent();
                $table->primary(['user_id', 'post_id']);
                $table->index('post_id');
            });
        }

        if (! Schema::hasTable('social_comments')) {
            Schema::create('social_comments', function (Blueprint $table) {
                $table->id();
                $table->foreignId('post_id')->constrained('social_posts')->cascadeOnDelete();
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('parent_id')->nullable()->constrained('social_comments')->cascadeOnDelete();
                $table->text('body');
                $table->unsignedInteger('likes_count')->default(0);
                $table->timestamp('created_at')->useCurrent();
                $table->index(['post_id', 'created_at']);
                $table->index('parent_id');
            });
        }

        if (! Schema::hasTable('social_comment_likes')) {
            Schema::create('social_comment_likes', function (Blueprint $table) {
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
                $table->foreignId('comment_id')->constrained('social_comments')->cascadeOnDelete();
                $table->timestamp('created_at')->useCurrent();
                $table->primary(['user_id', 'comment_id']);
                $table->index('comment_id');
            });
        }
    }

    public function down(): void
    {
        // Intentionally empty — shared DB may still hold app data.
    }
};
