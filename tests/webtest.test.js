const {By,Key,Builder} = require("selenium-webdriver");
require("chromedriver");

async function example(searchString, back){

    //To wait for browser to build and launch properly
    let driver = await new Builder().forBrowser("chrome").build();

    //To fetch http://google.com from the browser with our code.
    await driver.get("https://cs4640.cs.virginia.edu/scp4exq/project/sprint4/?command=home");
    // await driver.get("https://google.com");

    //To send a search query by passing the value in searchString.
    await driver.findElement(By.id("email")).sendKeys("joeyelsisi@gmail.com",Key.RETURN);
    await driver.findElement(By.id("password")).sendKeys("12345",Key.RETURN);
    await driver.findElement(By.id("text-search")).sendKeys(searchString,Key.RETURN);

    try {
        var message = await driver.switchTo().alert().getText();
        await driver.switchTo().alert().accept();
    } catch (NoAlertPresentException){
        message = "";
    }

    //Verify the page title and print it
    if(back){
        await driver.navigate().back();
    } else {
        await driver.navigate().refresh();
    }

    var title = await driver.getTitle();
    console.log('Title is:',title);
    let rtrnObj = {
        "message": message,
        "title": title
    }
    //It is always a safe practice to quit the browser after execution
    await driver.quit();

    return rtrnObj;
}



beforeEach(() => {
    jest.setTimeout(80000);
});

function sum(a, b) {
    return a + b;
}


jest.setTimeout(30000);
test("TR1", () => {
    jest.setTimeout(30000);
    // var alertMock = jest.spyOn(window,'alert').mockImplementation();
    // expect(alertMock).toHaveBeenCalledTimes(1);
    let back = true;
    return example("adage", back).then(data =>{
        expect(data["title"]).toBe("Home");
        expect(data["message"]).toBe("Please enter a valid building name exactly as specified under the \"All Buildings\" button below.");
        }

    )
});


test("TR2", () => {
    jest.setTimeout(30000);
    let back = false;
    return example("Physical & Life Sci Bldg Rm", back).then(data =>{
            expect(data["title"]).toBe("Physical & Life Sci Bldg Rm");
            expect(data["message"]).toBe("");
        }

    )
});


test("TR3", () => {
    jest.setTimeout(30000);
    let back = true;
    return example("UVA E = Labor and Delivery", back).then(data =>{
            expect(data["title"]).toBe("Home");
        }
    )
});

test("TR4", () => {
    jest.setTimeout(30000);
    let back = false;
    return example("Old Cabell Hall", back).then(data =>{
            expect(data["title"]).toBe("Old Cabell Hall");
        }
    )
});

test("TR5", () => {
    jest.setTimeout(30000);
    let back = true;
    return example(35, back).then(data =>{
            expect(data["title"]).toBe("Home");
            expect(data["message"]).toBe("Please enter a valid building name exactly as specified under the \"All Buildings\" button below.");
        }
    )
});

test("TR6", () => {
    jest.setTimeout(30000);
    let back = false;
    return example("", back).then(data =>{
            expect(data["title"]).toBe("Home");
            expect(data["message"]).toBe("Please enter a valid building name exactly as specified under the \"All Buildings\" button below.");
        }
    )
});

test("TR7", () => {
    jest.setTimeout(30000);
    let back = false;
    return example("adage", back).then(data =>{
            expect(data["title"]).toBe("Home");
            expect(data["message"]).toBe("Please enter a valid building name exactly as specified under the \"All Buildings\" button below.");
        }
    )
});

test("TR8", () => {
    jest.setTimeout(30000);
    let back = true;
    return example("Physical & Life Sci Bldg Rm", back).then(data =>{
            expect(data["title"]).toBe("Home");
            expect(data["message"]).toBe("");
        }
    )
});

test("TR9", () => {
    jest.setTimeout(30000);
    let back = false;
    return example("UVA E = Labor and Delivery", back).then(data =>{
            expect(data["title"]).toBe("UVA E = Labor and Delivery");
        }
    )
});

test("TR10", () => {
    jest.setTimeout(30000);
    let back = true;
    return example("Old Cabell Hall", back).then(data =>{
            expect(data["title"]).toBe("Home");
        }
    )
});

test("TR11", () => {
    jest.setTimeout(30000);
    let back = false;
    return example(35, back).then(data =>{
            expect(data["title"]).toBe("Home");
            expect(data["message"]).toBe("Please enter a valid building name exactly as specified under the \"All Buildings\" button below.");
        }
    )
});

test("TR12", () => {
    jest.setTimeout(30000);
    let back = true;
    return example(35, back).then(data =>{
            expect(data["title"]).toBe("Home");
            expect(data["message"]).toBe("Please enter a valid building name exactly as specified under the \"All Buildings\" button below.");
        }
    )
});