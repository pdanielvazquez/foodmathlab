from OptimizationNutriscore import NutriscoreProblem, Food
from Thread import ThreadingOptimizationNutriscore
import Utils
import json

file = open('C:/xampp0/htdocs/foodmathlab-main/vendor/python/postdata.json', 'r')
data = json.load(file)

n = 0.5
population = 200
replace = 0.5
generations = 10000
seed = 0
method = "NSP"
drink = False
cheese = False
force_letter = ""
score = None

if data is None or not "referenceFood" in data:
    return json_response({"success": False, "result": "No se puede iniciar el proceso sin un alimento de referencia"})

json_food_input = data["referenceFood"]
if "score" in data["referenceFood"]:
    score = data["referenceFood"]["score"]
if "maxValues" in data:
    max = [13.5, 100, 30, 10, 1000, 100, 5, 10]
    aux_max = Utils.parse_values_json_incomplete(data["maxValues"])
    for i in range(len(max)):
        if aux_max[i] == -1:
            aux_max[i] = max[i]
    max = aux_max
else:
    max = [13.5, 100, 30, 10, 1000, 100, 5, 10]
if "minValues" in data:
    min = [0, 0, 0, 0, 0, 0, 0, 0]
    aux_min = Utils.parse_values_json_incomplete(data["minValues"])
    for i in range(len(min)):
        if aux_min[i] == -1:
            aux_min[i] = min[i]
    min = aux_min
else:
    min = [0, 0, 0, 0, 0, 0, 0, 0]
if "lockValues" in data:
    lock = Utils.parse_flag_json_incomplete(data["lockValues"])
    ref_data = Utils.parse_values_json_incomplete(json_food_input)
    for i in range(len(lock)):
        if lock[i]:
            max[i] = min[i] = ref_data[i]

    if "forceLetter" in data["lockValues"]:
        force_letter = data["lockValues"]["forceLetter"]

for i in range(len(max)):
    if min[i] > max[i]:
        max[i] = min[i]

if "foodProperties" in data:
    if "cheese" in data["foodProperties"]:
        cheese = data["foodProperties"]["cheese"]
    if "drink" in data["foodProperties"]:
        drink = data["foodProperties"]["drink"]
    if "method" in data["foodProperties"]:
        method = data["foodProperties"]["method"].upper()

if "params" in data:
    if "weightNutriscore" in data["params"]:
        n = data["params"]["weightNutriscore"]
        if n > 1:
            n = 1
    if "population" in data["params"]:
        population = data["params"]["population"]
    if "replace" in data["params"]:
        replace = data["params"]["replace"]
    if "generations" in data["params"]:
        generations = data["params"]["generations"]
    if "seed" in data["params"]:
        seed = data["params"]["seed"]


ref_food = Food(precision=10)
ref_food.encode(json_food_input)
nutriscore_problem = NutriscoreProblem(ref_food, n, max, min, method, drink, cheese, force_letter, score)

if "score" not in data["referenceFood"]:
    data["referenceFood"]["score"] = nutriscore_problem.nutri_score(ref_food)
data["referenceFood"]["letter"] = Utils.nutri_score(data["referenceFood"]["score"])
query = DataBaseManager.new_process(data)
if query[0]:
    token = query[1]
    ThreadingOptimizationNutriscore(nutriscore_problem.solve, population, replace, generations, query[1], seed)
    return json_response({"success": True, "token": token})
else:
    return json_response({"success": False, "errorMessage": query[1]})