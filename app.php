//?Instructions
//?Tally the results of a small football competition.
//?
//?Based on an input file containing which team played against which and what the outcome was, create a file with a table like this:
//?
//?Team                           | MP |  W |  D |  L |  P
//?Devastating Donkeys            |  3 |  2 |  1 |  0 |  7
//?Allegoric Alaskans             |  3 |  2 |  0 |  1 |  6
//?Blithering Badgers             |  3 |  1 |  0 |  2 |  3
//?Courageous Californians        |  3 |  0 |  1 |  2 |  1
//?What do those abbreviations mean?
//?
//?MP: Matches Played
//?W: Matches Won
//?D: Matches Drawn (Tied)
//?L: Matches Lost
//?P: Points
//?A win earns a team 3 points. A draw earns 1. A loss earns 0.
//?
//?The outcome should be ordered by points, descending. In case of a tie, teams are ordered alphabetically.
<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class Tournament
    {
        public $MP = [];
        public $W = [];
        public $D = [];
        public $L = [];
        public $P = [];
        public $equipos;
        public function __construct($scores){
            $this->equipos = explode(";", $scores);

        }
        public function asignacionPuntos(){
            foreach ($this->equipos as $key => $value) {
                if($key%3 == 2){
                    switch ($this->equipos[$key]) {
                        case 'win':
                            $nombreEquipo = $this->equipos[$key-2];
                            $nombreEquipo2 = $this->equipos[$key-1];
                            ($this->W[$nombreEquipo] ?? null) ? $this->W[$nombreEquipo] += 1 : $this->W[$nombreEquipo] = 1;
                            ($this->L[$nombreEquipo2] ?? null) ? $this->L[$nombreEquipo2] += 1 : $this->L[$nombreEquipo2] = 1;
                            ($this->P[$nombreEquipo] ?? null) ? $this->P[$nombreEquipo] += 3 : $this->P[$nombreEquipo] = 3;
                            break;
                        case 'draw':
                            $nombreEquipo = $this->equipos[$key-2];
                            $nombreEquipo2 = $this->equipos[$key-1];
                            ($this->D[$nombreEquipo] ?? null) ? $this->D[$nombreEquipo] += 1 : $this->D[$nombreEquipo] = 1;
                            ($this->D[$nombreEquipo2] ?? null) ? $this->D[$nombreEquipo2] += 1 : $this->D[$nombreEquipo2] = 1;

                            ($this->P[$nombreEquipo] ?? null) ? $this->P[$nombreEquipo] += 1 : $this->P[$nombreEquipo] = 1;
                            ($this->P[$nombreEquipo2] ?? null) ? $this->P[$nombreEquipo2] += 1 : $this->P[$nombreEquipo2] = 1;
                            break;
                        case 'loss':
                            $nombreEquipo = $this->equipos[$key-1];
                            $nombreEquipo2 = $this->equipos[$key-2];
                            ($this->W[$nombreEquipo] ?? null) ? $this->W[$nombreEquipo] += 1 : $this->W[$nombreEquipo] = 1;
                            ($this->L[$nombreEquipo2] ?? null) ? $this->L[$nombreEquipo2] += 1 : $this->L[$nombreEquipo2] = 1;
                            ($this->P[$nombreEquipo] ?? null) ? $this->P[$nombreEquipo] += 3 : $this->P[$nombreEquipo] = 3;
                            break;
                    }
                }else{
                    ($this->MP[$this->equipos[$key]] ?? null) ? $this->MP[$this->equipos[$key]] += 1 : $this->MP[$this->equipos[$key]] = 1;
                }
            }
        }
        public function validarEquipos(){
            $equiposFaltantesW = array_diff_key($this->MP, $this->W);
            foreach ($equiposFaltantesW as $key => $value) {
                $this->W[$key] = 0;
            }
            $equiposFaltantesD = array_diff_key($this->MP, $this->D);
            foreach ($equiposFaltantesD as $key => $value) {
                $this->D[$key] = 0;
            }
            $equiposFaltantesL = array_diff_key($this->MP, $this->L);
            foreach ($equiposFaltantesL as $key => $value) {
                $this->L[$key] = 0;
            }
            $equiposFaltantesP = array_diff_key($this->MP, $this->P);
            foreach ($equiposFaltantesP as $key => $value) {
                $this->P[$key] = 0;
            }
        }
        public function tablaResultados(){
            echo "        Team                  | MP | W  | D  | L  | P  |\n  ";
            echo "---------------------------------------------------\n";
            foreach ($this->MP as $equipo => $partidosJugados){
                echo str_pad($equipo, 30)."| ";
                echo str_pad(strval($partidosJugados), 3)."| ";
                echo str_pad(($this->W[strval([$equipo]) ?? 0),3)."| ";
                echo str_pad(($this->D[$equipo] ?? 0),3)."| ";
                echo str_pad(($this->L[$equipo] ?? 0),3)."| ";
                echo str_pad(($this->P[$equipo] ?? 0),3)."| "."\n";
            }
        }
    }
    $obj = new Tournament("Allegoric Alaskans;Blithering Badgers;win;Devastating Donkeys;Courageous Californians;draw;Devastating Donkeys;Allegoric Alaskans;win;Courageous Californians;Blithering Badgers;loss;Blithering Badgers;Devastating Donkeys;loss;Allegoric Alaskans;Courageous Californians;win");

    $obj->asignacionPuntos();
    $obj->validarEquipos();
    $obj->tablaResultados();
