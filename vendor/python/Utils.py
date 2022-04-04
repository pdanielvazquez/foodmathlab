
def energy_a_points(energy, drink):
    if drink:
        if energy <= 0:
            return 0
        elif energy <= 30:
            return 1
        elif energy <= 60:
            return 2
        elif energy <= 90:
            return 3
        elif energy <= 120:
            return 4
        elif energy <= 150:
            return 5
        elif energy <= 180:
            return 6
        elif energy <= 210:
            return 7
        elif energy <= 240:
            return 8
        elif energy <= 270:
            return 9
        else:
            return 10
    else:
        if energy <= 335:
            return 0
        elif energy <= 670:
            return 1
        elif energy <= 1005:
            return 2
        elif energy <= 1340:
            return 3
        elif energy <= 1675:
            return 4
        elif energy <= 2010:
            return 5
        elif energy <= 2345:
            return 6
        elif energy <= 2680:
            return 7
        elif energy <= 3015:
            return 8
        elif energy <= 3350:
            return 9
        else:
            return 10


def sugar_a_points(sugar, drink):
    if drink:
        if sugar <= 0:
            return 0
        elif sugar <= 1.5:
            return 1
        elif sugar <= 3:
            return 2
        elif sugar <= 4.5:
            return 3
        elif sugar <= 6:
            return 4
        elif sugar <= 7.5:
            return 5
        elif sugar <= 9:
            return 6
        elif sugar <= 10.5:
            return 7
        elif sugar <= 12:
            return 8
        elif sugar <= 13.5:
            return 9
        else:
            return 10
    else:
        if sugar <= 4.5:
            return 0
        elif sugar <= 9:
            return 1
        elif sugar <= 13.5:
            return 2
        elif sugar <= 18:
            return 3
        elif sugar <= 22.5:
            return 4
        elif sugar <= 27:
            return 5
        elif sugar <= 31:
            return 6
        elif sugar <= 36:
            return 7
        elif sugar <= 40:
            return 8
        elif sugar <= 45:
            return 9
        else:
            return 10


def sat_fat_a_points(sat_fat, lipids):
    if lipids:
        if sat_fat <= 10:
            return 0
        elif sat_fat < 16:
            return 1
        elif sat_fat < 22:
            return 2
        elif sat_fat < 28:
            return 3
        elif sat_fat < 34:
            return 4
        elif sat_fat < 40:
            return 5
        elif sat_fat < 46:
            return 6
        elif sat_fat < 52:
            return 7
        elif sat_fat < 58:
            return 8
        elif sat_fat < 64:
            return 9
        else:
            return 10
    else:
        if sat_fat <= 1:
            return 0
        elif sat_fat <= 2:
            return 1
        elif sat_fat <= 3:
            return 2
        elif sat_fat <= 4:
            return 3
        elif sat_fat <= 5:
            return 4
        elif sat_fat <= 6:
            return 5
        elif sat_fat <= 7:
            return 6
        elif sat_fat <= 8:
            return 7
        elif sat_fat <= 9:
            return 8
        elif sat_fat <= 10:
            return 9
        else:
            return 10


def sodium_a_points(sodium):
    if sodium <= 90:
        return 0
    elif sodium <= 180:
        return 1
    elif sodium <= 270:
        return 2
    elif sodium <= 360:
        return 3
    elif sodium <= 450:
        return 4
    elif sodium <= 540:
        return 5
    elif sodium <= 630:
        return 6
    elif sodium <= 720:
        return 7
    elif sodium <= 810:
        return 8
    elif sodium <= 900:
        return 9
    else:
        return 10


def z_c_points(fv, drink):
    if drink:
        if fv <= 40:
            return 0
        elif fv <= 60:
            return 2
        elif fv <= 80:
            return 4
        else:
            return 10
    else:
        if fv <= 40:
            return 0
        elif fv <= 60:
            return 1
        elif fv <= 80:
            return 2
        else:
            return 5


def fiber_c_points(fiber, method):
    if method == "NSP":
        if fiber <= 0.7:
            return 0
        elif fiber <= 1.4:
            return 1
        elif fiber <= 2.1:
            return 2
        elif fiber <= 2.8:
            return 3
        elif fiber <= 3.5:
            return 4
        else:
            return 5
    elif method == "AOAC":
        if fiber <= 0.9:
            return 0
        elif fiber <= 1.9:
            return 1
        elif fiber <= 2.8:
            return 2
        elif fiber <= 3.7:
            return 3
        elif fiber <= 4.7:
            return 4
        else:
            return 5


def protein_c_points(protein):
    if protein <= 1.6:
        return 0
    elif protein <= 3.2:
        return 1
    elif protein <= 4.8:
        return 2
    elif protein <= 6.4:
        return 3
    elif protein <= 8:
        return 4
    else:
        return 5

def nutri_score(value):
    if value <= -1:
        return 'A'
    elif value <= 2:
        return 'B'
    elif value <= 10:
        return 'C'
    elif value <= 18:
        return 'D'
    else:
        return 'E'

def parse_json(data):
    result = [data["sugar"], data["carbs"], data["totalFat"], data["satFat"], data["sodium"], data["f&v"],
              data["fiber"], data["protein"], data["energy"]]
    return result

def parse_flag_json_incomplete(data):
    verify_json_flag(data)
    result = [data["sugar"], False, False, data["satFat"], data["sodium"], data["f&v"],
              data["fiber"], data["protein"]]
    return result

def parse_values_json_incomplete(data):
    verify_json_values(data)
    result = [data["sugar"], -1, -1, data["satFat"], data["sodium"], data["f&v"],
              data["fiber"], data["protein"]]
    return result

def parse_incomplete_array(data):
    result = [False, False, False, False, False, False, False, False]
    for s in data:
        if s.lower == "sugar":
            result[0] = True
        elif s.lower == "satFat":
            result[3] = True
        elif s.lower == "sodium":
            result[4] = True
        elif s.lower == "f&v":
            result[5] = True
        elif s.lower == "fiber":
            result[6] = True
        elif s.lower == "protein":
            result[7] = True
    return result

def verify_json_values(data):
    if "sugar" not in data:
        data["sugar"] = -1
    if "satFat" not in data:
        data["satFat"] = -1
    if "sodium" not in data:
        data["sodium"] = -1
    if "f&v" not in data:
        data["f&v"] = -1
    if "fiber" not in data:
        data["fiber"] = -1
    if "protein" not in data:
        data["protein"] = -1

def verify_json_flag(data):
    if "sugar" not in data:
        data["sugar"] = False
    if "satFat" not in data:
        data["satFat"] = False
    if "sodium" not in data:
        data["sodium"] = False
    if "f&v" not in data:
        data["f&v"] = False
    if "fiber" not in data:
        data["fiber"] = False
    if "protein" not in data:
        data["protein"] = False