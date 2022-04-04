import GA
import Utils
import math


class Food:
    def __init__(self, sugar=0.0, carbohydrates=0.0, total_fat=1.0, saturated_fat=0.0, sodium=0.0, z=0.0, fiber=0.0,
                 protein=0.0, energy=0, weight=None, precision=1):
        self.__precision = precision
        self.__weight = weight
        if energy == 0:
            self.__energy = round((9 * total_fat) + (4 * carbohydrates) + (4 * protein), self.__precision)
        else:
            self.__energy = round(energy, self.__precision)
        self.__sugar = round(sugar, self.__precision)
        self.__carbohydrates = round(carbohydrates, self.__precision)
        self.__total_fat = round(total_fat, self.__precision)
        self.__sat_fat = round(saturated_fat, self.__precision)
        self.__sodium = round(sodium, self.__precision)
        self.__z = z
        if weight is None:
            self.__pz = round(z, self.__precision)
        else:
            self.__pz = round(((2 * z) / weight) * 100.0, self.__precision)
        self.__fiber = round(fiber, self.__precision)
        self.__protein = round(protein, self.__precision)

    def ratio_carbs_fat_energy(self, carbs, fat, energy):
        if self.__sugar < 1 and carbs != 1:
            self.__carbohydrates = round(carbs, self.__precision)
        else:
            self.__carbohydrates = round(self.__sugar * carbs, self.__precision)
        if self.__sat_fat < 1 and fat != 1:
            self.__total_fat = round(fat, self.__precision)
        else:
            self.__total_fat = round(self.__sat_fat * fat, self.__precision)
        self.__energy = (9 * self.__total_fat) + (4 * self.__carbohydrates) + (4 * self.__protein)
        self.__energy = round(self.__energy * energy, self.__precision)

    def set_weight(self, weight):
        self.__weight = weight
        self.__pz = ((2 * self.__z) / weight) * 100.0

    def set_sugar(self, sugar):
        self.__sugar = sugar

    def set_carbohydrates(self, carbs):
        self.__carbohydrates = carbs
        # self.__energy = (9 * self.__total_fat) + (4 * carbs) + (4 * self.__protein)

    def set_totalFat(self, total_fat):
        self.__total_fat = total_fat
        # self.__energy = (9 * total_fat) + (4 * self.__carbohydrates) + (4 * self.__protein)

    def set_saturated_fat(self, saturated_fat):
        self.__saturated_fat = saturated_fat
        self.__sat_fat = (saturated_fat / self.__total_fat) * 100.0

    def set_sodium(self, sodium):
        self.__sodium = sodium

    def set_z(self, z):
        if self.__weight is None:
            self.__pz = z
        else:
            self.__pz = ((2 * z) / self.__weight) * 100.0

    def set_fiber(self, fiber):
        self.__fiber = fiber

    def set_protein(self, protein):
        self.__protein = protein

    def get_energy(self):
        return self.__energy

    def get_weight(self):
        return self.__weight

    def get_sugar(self):
        return self.__sugar

    def get_totalFat(self):
        return self.__total_fat

    def get_saturated_fat(self):
        return self.__saturated_fat

    def get_sat_fat(self):
        return self.__sat_fat

    def get_sodium(self):
        return self.__sodium

    def get_z(self):
        return self.__z

    def get_fiber(self):
        return self.__fiber

    def get_protein(self):
        return self.__protein

    def minimal_decode(self):
        return [self.__sugar, self.__sat_fat, self.__sodium, self.__pz, self.__fiber, self.__protein]

    def short_decode(self):
        return [self.__sugar, self.__carbohydrates, self.__total_fat, self.__sat_fat, self.__sodium,
                self.__pz, self.__fiber, self.__protein]

    def decode(self):
        return [self.__sugar, self.__carbohydrates, self.__total_fat, self.__sat_fat, self.__sodium,
                self.__pz, self.__fiber, self.__protein, self.__energy]

    def decode_as_dict(self):
        dict = {
            "sugar": self.__sugar, "carbs": self.__carbohydrates, "totalFat": self.__total_fat,
            "satFat": self.__sat_fat, "sodium": self.__sodium, "f&v": self.__pz, "fiber": self.__fiber,
            "protein": self.__protein, "energy": self.__energy
        }
        return dict

    def encode(self, data):
        if isinstance(data, list):
            if len(data) == 6:
                self.__sugar = round(data[0], self.__precision)
                self.__sat_fat = round(data[1], self.__precision)
                self.__sodium = round(data[2], self.__precision)
                self.__pz = round(data[3], self.__precision)
                self.__fiber = round(data[4], self.__precision)
                self.__protein = round(data[5], self.__precision)
                self.__energy = 0
            elif len(data) == 7:
                self.__sugar = round(data[0], self.__precision)
                self.__sat_fat = round(data[1], self.__precision)
                self.__sodium = round(data[2], self.__precision)
                self.__pz = round(data[3], self.__precision)
                self.__fiber = round(data[4], self.__precision)
                self.__protein = round(data[5], self.__precision)
                self.__energy = round(data[6], self.__precision)
            else:
                self.__sugar = round(data[0], self.__precision)
                self.__carbohydrates = round(data[1], self.__precision)
                self.__total_fat = round(data[2], self.__precision)
                self.__sat_fat = round(data[3], self.__precision)
                self.__sodium = round(data[4], self.__precision)
                self.__pz = round(data[5], self.__precision)
                self.__fiber = round(data[6], self.__precision)
                self.__protein = round(data[7], self.__precision)
                if len(data) == 9:
                    self.__energy = round(data[8], self.__precision)
                else:
                    self.__energy = round((9 * self.__total_fat) + (4 * self.__carbohydrates) + (4 * self.__protein), self.__precision)
        else:
            self.__sugar = round(data["sugar"], self.__precision)
            if "carbs" in data:
                self.__carbohydrates = round(data["carbs"], self.__precision)
            if "totalFat" in data:
                self.__total_fat = round(data["totalFat"], self.__precision)
            self.__sat_fat = round(data["satFat"], self.__precision)
            self.__sodium = round(data["sodium"], self.__precision)
            if self.__weight is not None:
                self.__pz = round(((2 * data["f&v"]) / self.__weight) * 100.0, self.__precision)
            else:
                self.__pz = round(data["f&v"], self.__precision)
            self.__fiber = round(data["fiber"], self.__precision)
            self.__protein = round(data["protein"], self.__precision)
            if "energy" in data:
                self.__energy = round(data["energy"], self.__precision)
            else:
                self.__energy = round((9 * self.__total_fat) + (4 * self.__carbohydrates) + (4 * self.__protein), self.__precision)


class NutriscoreProblem:
    def __init__(self, ref_food=None, n=0.5, max=[13.5, 100, 30, 10, 1000, 100, 5, 10], min=[0, 0, 0, 0, 0, 0, 0, 0],
                 method="NSP", drink=False, cheese=False, force_letter="", ref_score=None):
        self.__max_values = max
        self.__min_values = min
        self.__ref_food = ref_food
        self.__n = n
        self.__method = method
        self.__drink = drink
        self.__force_letter = force_letter
        self.__ref_score = ref_score
        if drink:
            self.__cheese = False
        else:
            self.__cheese = cheese
        if ref_food is not None and ref_score is None:
            self.__nutri_ref = self.nutri_score(ref_food)
            self.food_to_string(ref_food)
        elif ref_score is not None:
            self.__nutri_ref = ref_score
            self.food_to_string(ref_food)
        else:
            self.__nutri_ref = 0
        if len(max) == 8 or len(max) == 6:
            dict = ref_food.decode_as_dict()
            sugar = dict["sugar"]
            carbs = dict["carbs"]
            sat_fat = dict["satFat"]
            fat = dict["totalFat"]
            energy = dict["energy"]
            aprox_energy = (9 * fat) + (4 * carbs) + (4 * dict["protein"])
            self.__ratio_energy = float(energy) / float(aprox_energy)
            if sugar == carbs:
                self.__ratio_sugar = 1.0
            elif sugar == 0:
                self.__ratio_sugar = carbs
            else:
                self.__ratio_sugar = float(carbs) / float(sugar)
            if sat_fat == fat:
                self.__ratio_fat = 1.0
            elif sat_fat == 0:
                self.__ratio_fat = fat
            else:
                self.__ratio_fat = float(fat) / float(sat_fat)

            self.__ratios = True
        else:
            self.__ratios = False

    def food_to_string(self, food):
        data = food.decode_as_dict()
        print(str(data))

    def data_food_comparison(self, c1, c2):
        print("sugar: " + str(c2[0] - c1[0]))
        print("carbs: " + str(c2[1] - c1[1]))
        print("total fat: " + str(c2[2] - c1[2]))
        print("sat fat: " + str(c2[3] - c1[3]))
        print("sodium: " + str(c2[4] - c1[4]))
        print("fruits and vegetables: " + str(c2[5] - c1[5]))
        print("fiber: " + str(c2[6] - c1[6]))
        print("protein: " + str(c2[7] - c1[7]))
        print("\n")

    def compute_a_points(self, food):
        a_points = 0
        a_points += Utils.energy_a_points(food.get_energy(), self.__drink)
        a_points += Utils.sugar_a_points(food.get_sugar(), self.__drink)
        a_points += Utils.sat_fat_a_points(food.get_sat_fat(), False)
        a_points += Utils.sodium_a_points(food.get_sodium())
        return a_points

    def compute_c_points(self, food):
        c_points = 0
        c_points += Utils.z_c_points(food.get_z(), self.__drink)
        c_points += Utils.fiber_c_points(food.get_fiber(), self.__method)
        c_points += Utils.protein_c_points(food.get_protein())
        return c_points

    def nutri_score_with_description(self, food, cheese=False, drink=False, method='NSP', lipids=False):
        result = {}
        a_points = 0
        a_points += Utils.energy_a_points(food.get_energy(), drink)
        a_points += Utils.sugar_a_points(food.get_sugar(), drink)
        a_points += Utils.sat_fat_a_points(food.get_sat_fat(), lipids)
        a_points += Utils.sodium_a_points(food.get_sodium())
        c_points = 0
        c_points += Utils.z_c_points(food.get_z(), drink)
        c_points += Utils.fiber_c_points(food.get_fiber(), method)
        c_points += Utils.protein_c_points(food.get_protein())

        result["energy"] = Utils.energy_a_points(food.get_energy(), drink)
        result["sugar"] = Utils.sugar_a_points(food.get_sugar(), drink)
        result["satFat"] = Utils.sat_fat_a_points(food.get_sat_fat(), lipids)
        result["sodium"] = Utils.sodium_a_points(food.get_sodium())
        result["f&v"] = Utils.z_c_points(food.get_z(), drink)
        result["fiber"] = Utils.fiber_c_points(food.get_fiber(), method)
        result["protein"] = Utils.protein_c_points(food.get_protein())
        result["A"] = a_points
        result["C"] = c_points

        if a_points >= 11 and not cheese:
            e = result["f&v"]
            if e >= 5:
                nutriscore = a_points - c_points
            else:
                f = result["fiber"]
                nutriscore = a_points - e - f
        else:
            nutriscore = a_points - c_points

        result["nutriscore"] = nutriscore
        return result


    def nutri_score(self, food):
        a = self.compute_a_points(food)
        c = self.compute_c_points(food)
        if a >= 11 and not self.__cheese:
            e = Utils.z_c_points(food.get_z(), self.__drink)
            if e >= 5:
                return a - c
            else:
                f = Utils.fiber_c_points(food.get_fiber(), self.__method)
                return a - e - f
        else:
            return a - c

    def map_letter(self, value):
        if value == 'A':
            return 1
        elif value == 'B':
            return 0.8
        elif value == 'C':
            return 0.65
        elif value == 'D':
            return 0.5
        else:
            return 0

    def fitness(self, data):
        if not self.__ratios and (data[2] < data[3] or data[1] < data[0]):
            return 0

        food = Food()
        food.encode(data)
        if self.__ratios:
            food.ratio_carbs_fat_energy(self.__ratio_sugar, self.__ratio_fat, self.__ratio_energy)

        if len(self.__max_values) == 8:
            food_data = food.short_decode()
        elif len(self.__max_values) == 6:
            food_data = food.minimal_decode()

        nutri = self.nutri_score(food)
        norm_nutri = self.map_letter(Utils.nutri_score(nutri))
        c = self.compute_c_points(food)
        norm_c = (c / 15)
        a = self.compute_a_points(food)
        norm_a = 1 - (a / 40)

        weight = self.__n / 3.0
        weight_n = weight
        weight_c = weight
        weight_a = weight
        weight_dist = 1 - self.__n
        regulation = 0

        penalty_flag = False
        # Penalization
        if self.__force_letter != "":
            fl = self.map_letter(self.__force_letter)
            if norm_nutri != fl:
                '''penalization = (self.__n * 0.5)
                valuable = penalization * 0.5
                weight_n = self.__n / 3.0
                weight_c = (self.__n / 3.0) + valuable
                weight_a = (self.__n / 3.0) + valuable
                weight_dist = 1 - (self.__n + penalization)'''
                weight_n = weight
                weight_c = weight
                weight_a = weight
                weight_dist = 0
                penalty_flag = True

        elif self.__nutri_ref != 0:
            nl = Utils.nutri_score(self.__nutri_ref)
            nm = self.map_letter(nl)
            if norm_nutri == nm:
                regulation = 0.5 * (1 - self.__n)
            else:
                regulation = abs(norm_nutri - nm) * (1 - self.__n)

        if self.__n < 1 and not penalty_flag:
            if self.__ref_food is None:
                distance = self.distance_to_max(food_data)
                if distance > 0.5:
                    norm_distance = 0
                else:
                    norm_distance = distance
            else:
                if len(self.__max_values) == 8:
                    distance = self.distance(food_data, self.__ref_food.short_decode())
                elif len(self.__max_values) == 6:
                    distance = self.distance(food_data, self.__ref_food.minimal_decode())
                if distance > 1:
                    norm_distance = 0
                else:
                    norm_distance = 1 - distance
        else:
            norm_distance = 0

        # print(regulation)
        # oldop = (norm_nutri * weight_n) + (norm_a * weight_a) + (norm_distance * weight_dist)

        op = (norm_nutri * weight_n) + (norm_a * weight_a) + (norm_c * weight_c) + (
                    norm_distance * weight_dist) - regulation
        return op

    def distance_to_max(self, v1):
        result = 0.0
        for i in range(len(v1)):
            result += math.pow((self.__max_values[i] - v1[i]) / (self.__max_values[i] - self.__min_values[i]), 2)
        dist = math.sqrt(result) / math.sqrt(len(v1))
        return dist

    def distance(self, v1, v2):
        result = 0.0
        for i in range(len(v1)):
            if self.__max_values[i] == self.__min_values[i]:
                if self.__max_values[i] != 0:
                    aux = math.pow((v1[i] - v2[i]) / self.__max_values[i], 2)
                    if aux > 1:
                        result += 1
                    else:
                        result += math.pow((v1[i] - v2[i]) / self.__max_values[i], 2)
                else:
                    aux = math.pow(v1[i] - v2[i], 2)
                    if aux > 1:
                        result += 1
                    else:
                        result += math.pow(v1[i] - v2[i], 2)
            else:
                aux = math.pow((v1[i] - v2[i]) / (self.__max_values[i] - self.__min_values[i]), 2)
                if aux > 1:
                    result += 1
                else:
                    result += math.pow((v1[i] - v2[i]) / (self.__max_values[i] - self.__min_values[i]), 2)
        dist = math.sqrt(result) / math.sqrt(len(v1))
        return dist

    def solve(self, population=200, replace=0.5, generations=10000, seed=0):
        genetic = GA.RealGeneticAlgorithm(population, self.fitness, len(self.__max_values), self.__max_values,
                                          self.__min_values, replace, generations, 0.00000001, 0.9,
                                          self.__ref_food.decode(), 0.05, True, None, None, seed)
        best, generations, avg_fit, best_per_gen, last_gen_population = genetic.evolve()
        best_food = Food()
        best_food.encode(best.get_genome())
        if self.__ratios:
            best_food.ratio_carbs_fat_energy(self.__ratio_sugar, self.__ratio_fat, self.__ratio_energy)
        best_score = self.nutri_score(best_food)
        best_letter = Utils.nutri_score(best_score)

        nutri_list = list()
        nearest_list = list()
        # for gen in last_gen_population:
        '''for gen in best_per_gen:
            food = Food()
            #food.encode(gen.getGenome())
            food.encode(gen[0].getGenome())

            val = self.nutri_score(food)
            #nutri_list.append([food, val])
            nutri_list.append({"food": food, "score": val})

            #val = self.distance(self.__ref_food.decode(), gen.getGenome())
            val = self.distance(self.__ref_food.decode(), gen[0].getGenome())
            #nearest_list.append([food, val])
            nearest_list.append({"food": food, "distance": val})
        '''
        # nutri_list.sort(key=lambda u: u[1])
        # nearest_list.sort(key=lambda u: u[1])

        # nutri_list.sort(key=lambda u: u["score"])
        # nearest_list.sort(key=lambda u: u["distance"])
        top_fitness = []
        for i in range(1, 6):
            top_food = Food()
            top_food.encode(last_gen_population[i].get_genome())
            if self.__ratios:
                top_food.ratio_carbs_fat_energy(self.__ratio_sugar, self.__ratio_fat, self.__ratio_energy)
            top_score = self.nutri_score(top_food)
            top_letter = Utils.nutri_score(top_score)
            top_fitness.append({"food": top_food, "score": top_score, "letter": top_letter,
                                "fitness": last_gen_population[i].get_fitness()})

        json_best = {"food": best_food, "score": best_score, "letter": best_letter, "fitness": best.get_fitness()}

        json_result = {"bestFitness": json_best, "topFitness": top_fitness}

        # return {"nearest": nearest_list, "nutriscore": nutri_list, "bestFitness": json_best}
        return json_result
