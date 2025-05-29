        <?php

        use Illuminate\Database\Migrations\Migration;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Support\Facades\Schema;

        return new class extends Migration
        {
            /**
             * Run the migrations.
             */
            public function up(): void
            {
                Schema::create('t_komentar', function (Blueprint $table) {
                    $table->id('id_komentar');
                    $table->unsignedBigInteger('id_kriteria')->index();
                    $table->string('komen');    
                    $table->string('oleh')->nullable();
                    $table->timestamps();

                    $table->foreign('id_kriteria')->references('id_kriteria')->on('t_kriteria');
                });
            }

            /**
             * Reverse the migrations.
             */
            public function down(): void
            {
                Schema::dropIfExists('komentar');
            }
        };